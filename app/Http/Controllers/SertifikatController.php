<?php
namespace App\Http\Controllers;

use App\Models\Sertifikat;
use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class SertifikatController extends Controller
{

    public function status($id)
    {
        $sertifikat = Sertifikat::findOrFail($id); // Cari sertifikat berdasarkan ID
        $sertifikat->status = !$sertifikat->status; // Ganti status: on menjadi off atau sebaliknya
        $sertifikat->save(); // Simpan perubahan

        return redirect()->back()->with('success', 'Status sertifikat berhasil diubah!');
    }

    public function index()
    {
        $training = training::all();

        // Retrieve all trainings ordered by the created date
        $sertifikat = Sertifikat::orderBy('created_at', 'desc')->get();

        // Add formatted date range to each serti$sertifikat
        foreach ($sertifikat as $data) {
            $startDate = Carbon::parse($data->tanggal_mulai);
            $endDate = Carbon::parse($data->tanggal_selesai);

            // Check if the start and end dates are in the same month
            if ($startDate->format('F Y') === $endDate->format('F Y')) {
                $formattedStartDate = $startDate->format('j');
                $formattedEndDate = $endDate->format('j');
                $formattedMonth = $startDate->translatedFormat('F');
                $formattedYear = $startDate->translatedFormat('Y');

                $data->formatted_tanggal = "{$formattedMonth} {$formattedStartDate} - {$formattedEndDate} , {$formattedYear}";
            } else {
                // Different months
                $formattedStartDate = $startDate->format('F j');
                $formattedEndDate = $endDate->format('F j ,Y');

                $data->formatted_tanggal = "{$formattedStartDate} - {$formattedEndDate}";
            }
        }

        return view('sertifikat.index', compact('sertifikat', 'training'));
    }

    public function create()
    {
        $sertifikat = Sertifikat::all();
        $training = Training::all();
        return view('sertifikat.create', compact('sertifikat', 'training'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'id_training' => 'required',
        ]);

        $sertifikat = new Sertifikat;
        $sertifikat->nama_penerima = $request->nama_penerima;
        $sertifikat->id_training = $request->id_training;

        $sertifikat->save();

        toast('Data has been submited!', 'success')->position('bottom-end');
        return redirect()->route('sertifikat.index');

    }

    public function show($id)
    {
        $sertifikat = Sertifikat::FindOrFail($id);
        $training = training::all();
        return view('sertifikat.show', compact('sertifikat', 'training'));

    }

    public function edit($id)
    {
        $sertifikat = Sertifikat::FindOrFail($id);
        $training = training::all();

        toast('Data has been Updated!', 'success')->position('bottom-end');
        return view('sertifikat.edit', compact('sertifikat', 'training'));

    }

    public function update(Request $request, $id)
    {
        $sertifikat = Sertifikat::FindOrFail($id);
        $sertifikat->nama_penerima = $request->nama_penerima;
        $sertifikat->id_training = $request->id_training;
        $sertifikat->status = $request->status;

        $sertifikat->save();

        return redirect()->route('sertifikat.index')->with('success', 'Data berhasil ditambahkan');

    }

    public function destroy($id)
    {
        $sertifikat = Sertifikat::FindOrFail($id);
        $sertifikat->delete();

        toast('Data has been Deleted!', 'success')->position('bottom-end');
        return redirect()->route('sertifikat.index');

    }

    private function formatWithOrdinal($date)
    {
        $day = $date->day;

        // Tentukan suffix
        if ($day % 10 == 1 && $day != 11) {
            $suffix = 'st';
        } elseif ($day % 10 == 2 && $day != 12) {
            $suffix = 'nd';
        } elseif ($day % 10 == 3 && $day != 13) {
            $suffix = 'rd';
        } else {
            $suffix = 'th';
        }

        return $date->format('j') . $suffix;
    }

    public function printCertificate($id)
    {
        // Ambil data sertifikat dari database berdasarkan ID, termasuk data relasi dengan 'training'
        $sertifikat = Sertifikat::with('training')->findOrFail($id);

        // Ambil data training terkait
        $training = $sertifikat->training;

        // Pastikan ada data training
        if (!$training) {
            return abort(404, 'Training data not found');
        }

        // Format tanggal dari data training
        $startDate = Carbon::parse($training->tanggal_mulai);
        $endDate = Carbon::parse($training->tanggal_selesai);

        // Format tanggal dengan suffix ordinal
        $formattedStartDate = $this->formatWithOrdinal($startDate);
        $formattedEndDate = $this->formatWithOrdinal($endDate);

        if ($startDate->format('F Y') === $endDate->format('F Y')) {
            $formattedMonth = $startDate->translatedFormat('F');
            $formattedYear = $startDate->translatedFormat('Y');

            $formattedTanggal = "{$formattedMonth} {$formattedStartDate} - {$formattedEndDate}, {$formattedYear}";
        } else {
            $formattedStartDate = $startDate->format('F j');
            $formattedEndDate = $endDate->format('F j, Y');

            $formattedTanggal = "{$formattedStartDate} - {$formattedEndDate}";
        }

        // Mengubah bulan ke format Romawi
        $bulanRomawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII',
        ];
        $bulanRomaji = $bulanRomawi[$startDate->format('n')]; // 'n' menghasilkan angka bulan tanpa leading zero

        $nomorSertifikat = sprintf(
            'NO. %03d/%s/%s/%d',
            $sertifikat->id, // ID Nama Penerima
            $training->kode, // Kode dari tabel training
            $bulanRomaji, // Bulan dalam format Romawi
            $startDate->year// Tahun
        );

        // Path ke template PDF
        $templatePath = public_path('assets/img/sertifikat/template.pdf');

        if (!file_exists($templatePath)) {
            return abort(404, 'Template PDF not found');
        }

        // Inisialisasi FPDF
        $pdf = new Fpdi();

        // Inisialisasi FPDI dan FPDF
        define('FPDF_FONTPATH', public_path('fonts/'));

        // Daftarkan font
        $pdf->AddFont('AlexBrush-Regular', '', 'AlexBrush-Regular.php');

        // Menambahkan halaman dengan orientasi horizontal (landscape)
        $pdf->AddPage('L');

        // Set sumber file
        $pdf->setSourceFile($templatePath);

        // Import halaman pertama dari template PDF
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);

        // Nama Penerima
        $pdf->SetFont('AlexBrush-Regular', '', 45);
        $pdf->SetTextColor(0, 0, 0); // Set warna teks ke hitam
        $pdf->SetXY(5, 90);
        $pdf->Cell(0, 10, $sertifikat->nama_penerima, 0, 1, 'C'); // 'C' untuk center alignment

        // Nomor Sertifikat
        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetXY(113, 66);
        $pdf->Write(0, $nomorSertifikat);


        // Nama Pelatihan
        $pdf->SetFont('Helvetica', '', 15.5);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(4, 115);
        $pdf->Cell(0, 10, 'for ' . $sertifikat->training->nama_training, 0, 1, 'C');

        // Tanggal
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(4, 132.5);
        $pdf->Cell(0, 10, 'on ' . $formattedTanggal, 0, 1, 'C');

        // Nama file sesuai dengan nama penerima
        $fileName = "{$sertifikat->nama_penerima}_Sertifikat.pdf";

        // Output PDF
        return response($pdf->Output('S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "inline; filename=\"{$fileName}\"");

    }

}
