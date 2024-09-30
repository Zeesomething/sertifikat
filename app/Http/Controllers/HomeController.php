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
        $limitTraining = Training::orderBy('created_at', 'desc')->limit(4)->get();

        $training = Training::all();
        $sertifikat = Sertifikat::all();

        $total_sertifikat = Sertifikat::count('id');
        $total_pelatihan = Training::count('id');
        $total_terdaftar = Sertifikat::where('status', '0')->count('id'); 
        $total_selesai = Sertifikat::where('status', '1')->count('id');

        return view('home', compact('total_sertifikat', 'total_pelatihan' , 'training', 'sertifikat', 'limitTraining' , 'total_terdaftar', 'total_selesai'));       
 
    }

}
