<?php

namespace App\Http\Controllers;
use App\Models\Training;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    public function pelatihan($id)
    {
        $training = Training::findOrFail($id);
        return view('pelatihan', compact('training'));
    }
}
