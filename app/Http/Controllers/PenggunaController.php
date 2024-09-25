<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;

use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    // halaman untuk melihat siapa saja user yang ada
    public function index()
    {
        $user = User::all();
        $roles = Role::all();

        return view('pengguna', compact('user', 'roles'));
    }

    public function edit($id)
    {
        $user = User::FindOrFail($id);
        return view('pengguna.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->roles_id = $request->roles_id;
        
        $user->save();

        toast('Data has been Updated!', 'success')->position('top-end');
        return redirect()->route('pengguna.index')->with('success', 'Data berhasil ditambahkan');

    }

    public function destroy($id)
    {
        $user = User::FindOrFail($id);
        $user->delete();
        toast('Data has been Deleted!', 'success')->position('top-end');
        return redirect()->route('pengguna.index');
    }
}
