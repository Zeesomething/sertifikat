<?php

namespace App\Http\Controllers;
use App\Models\Sertifikat;
use App\Models\Training;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $total_sertifikat = Sertifikat::count('id');
        $total_pelatihan = Training::count('id');
        return view('home', compact('total_sertifikat', 'total_pelatihan'));
    }

}
