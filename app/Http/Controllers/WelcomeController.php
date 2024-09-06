<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Sertifikat;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

class WelcomeController extends Controller
{
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
    public function index()
    {
        $training = Training::orderBy('created_at', 'desc')->get();

        // Retrieve all trainings ordered by the created date

// Add formatted date range to each training
        foreach ($training as $data) {
            $startDate = Carbon::parse($data->tanggal_mulai);
            $endDate = Carbon::parse($data->tanggal_selesai);

            // Format dates with ordinal suffix
            $formattedStartDate = $this->formatWithOrdinal($startDate);
            $formattedEndDate = $this->formatWithOrdinal($endDate);

            if ($startDate->format('F Y') === $endDate->format('F Y')) {
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
        $limitTraining = $training->take(4);

        return view('layouts.user', compact('training', 'limitTraining'));  
    }
    public function checkCertificate(Request $request)
    {
        // Ambil input nomor sertifikat dari form
        $nomorSertifikatInput = $request->input('nomor_sertifikat');

        // Pecahkan input nomor sertifikat untuk mendapatkan bagian-bagian yang diperlukan
        $parts = explode('/', str_replace('NO. ', '', $nomorSertifikatInput));

        if (count($parts) !== 4) {
            // Jika format tidak sesuai
            return view('certificate-check', [
                'status' => 'error',
                'message' => 'Format nomor sertifikat tidak valid. Silakan cek kembali.',
            ]);
        }

        $idNamaPenerima = intval($parts[0]); // Bagian ID Nama Penerima
        $kodeTraining = $parts[1]; // Bagian Kode Training

        // Cek di database apakah sertifikat dengan ID penerima dan kode training ada
        $sertifikat = Sertifikat::with('training')->where('id', $idNamaPenerima)->first();
        $training = Training::where('kode', $kodeTraining)->first();

        if ($sertifikat && $training) {
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

            $message = "
            <table style='width:700px;'>
                <tr>
                    <th>Nama Penerima</th>
                    <th> : </th>
                    <th>{$sertifikat->nama_penerima}</th>
                </tr>
                <tr>
                    <th>Nama Training</th>
                    <th> : </th>
                    <th>{$training->nama_training}</th>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <th> : </th>
                    <th>{$formattedTanggal}</th>
                </tr>
            </table>
        ";
            return view('layouts.user', [
                'status' => 'success',
                'message' => $message,
            ]);
        } else {
            // Sertifikat tidak ditemukan
            return view('layouts.user', [
                'status' => 'error',
                'message' => 'Sertifikat tidak ditemukan. Silakan cek kembali.',
            ]);
        }
    }
}
