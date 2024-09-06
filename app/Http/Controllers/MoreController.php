<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

class MoreController extends Controller
{
    public function index()
    {
        $training = Training::orderBy('created_at', 'desc')->get();
        return view('more', compact('training'));
    }
}
