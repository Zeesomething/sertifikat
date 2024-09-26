<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // halaman untuk melihat siapa saja user yang ada
    public function index()
    {
        $user = User::orderBy('created_at', 'desc')->get();
        $roles = Role::all();

        return view('user', compact('user', 'roles'));
    }

    public function show($id)
    {
        $user = User::FindOrFail($id);
        return view('user.show', compact('user'));

    }

    public function edit($id)
    {
        $user = User::FindOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->roles_id = $request->roles_id;
        
        $user->save();

        toast('Data has been Updated!', 'success')->position('top-end');
        return redirect()->route('user.index')->with('success', 'Data berhasil ditambahkan');

    }

    public function destroy($id)
    {
        $user = User::FindOrFail($id);
        $user->delete();
        toast('Data has been Deleted!', 'success')->position('top-end');
        return redirect()->route('user.index');
    }
}
