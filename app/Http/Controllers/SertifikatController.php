<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
}
