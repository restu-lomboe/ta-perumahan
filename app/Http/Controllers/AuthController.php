<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('frontend.auth.login');
    }

    public function register(){
        return view('frontend.auth.register');
    }

    public function getlogin(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('admin.dashboard')->with('success', 'Welcome '.$request->email);
        }

        return redirect()->route('login')->with('error', 'Email atau password salah, silahkan coba kembali');
    }

    public function getRegister(Request $request){

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = new User;
<<<<<<< HEAD
        $user->role_id = 3; //role user
=======
        $user->role_id = 2; //role user
>>>>>>> origin/testing
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Register berhasil, silahkan login');
    }

    public function logout()
    {
        Auth::logout(); // Logout the currently authenticated user

        return redirect()->route('login')->with('success', 'Terimakasih, silahkan datang kembali');
    }
}
