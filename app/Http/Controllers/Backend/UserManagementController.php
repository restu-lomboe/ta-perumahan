<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index(){

        $users = User::orderBy('created_at', 'desc')->get();

        return view('backend.userManagement.index', compact('users'));
    }

    public function store(Request $request){

        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required',
        ]);

        try {

            $user = new User;
            $user->role_id = $request->role;
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'user berhasil ditambahkan');

    }

    public function detailJson(Request $request){

        $user = User::where('id', $request->get('id'))->first();

        return json_encode($user);
    }

    public function update(Request $request){

        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'role' => 'required',
            'password' => $request->password ? 'required|min:8|confirmed' : ''
        ]);

        $user = User::where('id', $request->get('id'))->first();

        $user->update([
            'role_id' => $request->role,
            'name' => $request->nama,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password
        ]);

        return redirect()->back()->with('success', 'user berhasil diubah');
    }
}
