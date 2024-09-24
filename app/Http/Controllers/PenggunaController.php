<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PenggunaController extends Controller
{
    // halaman untuk melihat siapa saja user yang ada
    public function index()
    {
        $user = User::all();
        return view('pengguna', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::FindOrFail($id);
        $user->delete();
        toast('Data has been Deleted!', 'success')->position('top-end');
        return redirect()->route('pengguna.index');
    }
}
