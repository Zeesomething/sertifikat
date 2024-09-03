<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Retrieve all trainings ordered by the created date
    $training = Training::orderBy('created_at', 'desc')->get();

    // Add formatted date range to each training
    foreach ($training as $data) {
        $startDate = Carbon::parse($data->tanggal_mulai);
        $endDate = Carbon::parse($data->tanggal_selesai);

        // Check if the start and end dates are in the same month
        if ($startDate->format('F Y') === $endDate->format('F Y')) {
            $formattedStartDate = $startDate->format('j');
            $formattedEndDate = $endDate->format('j');
            $formattedMonthYear = $startDate->translatedFormat('F Y');

            $data->formatted_tanggal = "{$formattedStartDate} - {$formattedEndDate} {$formattedMonthYear}";
        } else {
            // Different months
            $formattedStartDate = $startDate->format('j F');
            $formattedEndDate = $endDate->format('j F Y');

            $data->formatted_tanggal = "{$formattedStartDate} - {$formattedEndDate}";
        }
    }

    return view('training.index', compact('training'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('training.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $training = new Training;
    $training->nama_training = $request->nama_training;
    $training->tanggal_mulai = $request->tanggal_mulai;
    $training->tanggal_selesai = $request->tanggal_selesai;

    if ($request->hasFile('cover')) {
        $img = $request->file('cover');
        $name = rand(1000, 9999) . $img->getClientOriginalName();
        $img->move('images/training', $name);
        $training->cover = $name;
    }

    $training->konten = $request->konten;

    $training->save();

    return redirect()->route('training.index')->with('success', 'Data berhasil ditambahkan');
}




    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $training = Training::FindOrFail($id);

        return view('training.show', compact('training'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $training = Training::FindOrFail($id);
        return view('training.edit', compact('training'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $training = Training::FindOrFail($id);

        $training->nama_training = $request->nama_training;
        $training->tanggal_mulai = $request->tanggal_mulai;
        $training->tanggal_selesai = $request->tanggal_selesai;

        if ($request->hasFile('cover')) {
            $img = $request->file('cover');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/training', $name);
            $training->cover = $name;
        }

        $training->konten = $request->konten;

        $training->save();

        return redirect()->route('training.index')->with('success', 'Data berhasil ditambahkan');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $training = Training::FindOrFail($id);
        $training->delete();
        return redirect()->route('training.index')
            ->with('success', 'data berhasil dihapus');

    }
}
