<?php

// app/Http/Controllers/BackupController.php
namespace App\Http\Controllers;

class BackupController extends Controller
{
    public function createBackup()
    {
        $databaseName = escapeshellarg('PKL_Bartech'); // Pastikan nama database sudah aman
        $outputFile = escapeshellarg(storage_path('app/backup.sql')); // Escaping path file backup

        $command = "pg_dump -U postgres -h localhost $databaseName > $outputFile";

        // Menjalankan perintah backup
        $result = shell_exec($command);

        // Cek apakah file backup berhasil dibuat
        if (file_exists($outputFile)) {
            return response()->download($outputFile); // Unduh file backup
        } else {
            return back()->with('error', 'Backup gagal atau file tidak dibuat.');
        }

    }
}
