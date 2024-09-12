<?php

namespace App\Http\Controllers;
use App\Models\Sertifikat;
use App\Models\Training;
class HomeController extends Controller
{

    public function home(){
        if (auth()->user()->can('view_dashboard')) {
            return view('home');
        }
        return abort(403);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_sertifikat = Sertifikat::count('id');
        $total_pelatihan = Training::count('id');
        return view('home', compact('total_sertifikat', 'total_pelatihan'));
    }

}
