<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $training = Training::all();
        $training = Training::orderBy('created_at', 'desc')->get();

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
