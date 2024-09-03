<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
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

        return view('sertifikat.index', compact('sertifikat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sertifikat = Sertifikat::all();
        $training = Training::all();
        return view('sertifikat.create', compact('sertifikat', 'training'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sertifikat = new Sertifikat;
        $sertifikat->nama_penerima = $request->nama_penerima;
        $sertifikat->nomor_sertifikat = $request->nomor_sertifikat;
        $sertifikat->tanggal_mulai = $request->tanggal_mulai;
        $sertifikat->tanggal_selesai = $request->tanggal_selesai;
        $sertifikat->id_training = $request->id_training;

        $sertifikat->save();

        return redirect()->route('sertifikat.index')->with('success', 'Data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sertifikat = Sertifikat::FindOrFail($id);
        $training = training::all();
        return view('sertifikat.show', compact('sertifikat', 'training'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sertifikat = Sertifikat::FindOrFail($id);
        $training = training::all();
        return view('sertifikat.edit', compact('sertifikat', 'training'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sertifikat = Sertifikat::FindOrFail($id);
        $sertifikat->nama_penerima = $request->nama_penerima;
        $sertifikat->nomor_sertifikat = $request->nomor_sertifikat;
        $sertifikat->tanggal_mulai = $request->tanggal_mulai;
        $sertifikat->tanggal_selesai = $request->tanggal_selesai;
        $sertifikat->id_training = $request->id_training;

        $sertifikat->save();

        return redirect()->route('sertifikat.index')->with('success', 'Data berhasil ditambahkan');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sertifikat = Sertifikat::FindOrFail($id);
        $sertifikat->delete();
        return redirect()->route('sertifikat.index')
            ->with('success', 'data berhasil dihapus');

    }

    public function printCertificate($id)
    {
        // Ambil data sertifikat dari database berdasarkan ID
        $sertifikat = Sertifikat::with('training')->findOrFail($id);

        // Format tanggal
        $startDate = Carbon::parse($sertifikat->tanggal_mulai);
        $endDate = Carbon::parse($sertifikat->tanggal_selesai);

        if ($startDate->format('F Y') === $endDate->format('F Y')) {
            $formattedStartDate = $startDate->format('j');
            $formattedEndDate = $endDate->format('j');
            $formattedMonth = $startDate->translatedFormat('F');
            $formattedYear = $startDate->translatedFormat('Y');

            $formattedTanggal = "{$formattedMonth} {$formattedStartDate} - {$formattedEndDate}, {$formattedYear}";
        } else {
            $formattedStartDate = $startDate->format('F j');
            $formattedEndDate = $endDate->format('F j, Y');

            $formattedTanggal = "{$formattedStartDate} - {$formattedEndDate}";
        }

        // Path ke template PDF
        $templatePath = public_path('assets/img/sertifikat/template.pdf');

        if (!file_exists($templatePath)) {
            return abort(404, 'Template PDF not found');
        }

        // Inisialisasi FPDI dan FPDF
        $pdf = new Fpdi();

        // Menambahkan halaman dengan orientasi horizontal (landscape)
        $pdf->AddPage('L'); // 'L' untuk landscape, 'P' untuk portrait

        // Set sumber file
        $pdf->setSourceFile($templatePath);

        // Import halaman pertama dari template PDF
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);

        // Nama Penerima
        $pdf->SetFont('Helvetica', 'IB', 35);
        $pdf->SetTextColor(0, 0, 0); // Set warna teks ke hitam (0, 0, 0)
        $pdf->SetXY(5, 90); // Set posisi X ke 0 untuk memusatkan horizontal
        $pdf->Cell(0, 10, $sertifikat->nama_penerima, 0, 1, 'C'); // 'C' untuk center alignment

        // Nomor Sertifikat
        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->SetTextColor(255, 255, 255); // Set warna teks ke putih (255, 255, 255)
        $pdf->SetXY(113, 66); // Set posisi X dan Y sesuai kebutuhan
        $pdf->Write(0, $sertifikat->nomor_sertifikat);

        // Nama Penerima
        $pdf->SetFont('Helvetica', '', 15.5);
        $pdf->SetTextColor(0, 0, 0); // Set warna teks ke hitam (0, 0, 0)
        $pdf->SetXY(4, 115); // Set posisi X ke 0 untuk memusatkan horizontal
        $pdf->Cell(0, 10, ('for ') . $sertifikat->training->nama_training, 0, 1, 'C');

        // Menambahkan tanggal, posisikan di tengah
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetTextColor(0, 0, 0); // Set warna teks ke hitam (0, 0, 0)
        $pdf->SetXY(4, 132.5); // Set posisi X dan Y sesuai kebutuhan
        $pdf->Cell(0, 10, ('on ') . $formattedTanggal, 0, 1, 'C'); // 'C' untuk center alignment

        // Output PDF
        return response($pdf->Output('S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="certificate.pdf"');
    }
}
