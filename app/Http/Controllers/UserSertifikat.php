<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use Illuminate\Http\Request;

class UserSertifikatController extends Controller
{
    // Fungsi untuk mengecek nomor sertifikat
    public function cekSertifikat(Request $request)
    {
        // Validasi input
        $request->validate([
            'no_sertifikat' => 'required|string',
        ]);

        // Cari sertifikat berdasarkan nomor
        $sertifikat = Sertifikat::where('nomor_sertifikat', $request->no_sertifikat)->first();

        if ($sertifikat) {
            // Kirim data sertifikat ke tampilan dengan session flash
            return redirect()->back()->with('sertifikat', $sertifikat);
        } else {
            // Kirim pesan error jika nomor sertifikat tidak ditemukan
            return redirect()->back()->with('error', 'Nomor sertifikat tidak ditemukan.');
        }
    }
}
