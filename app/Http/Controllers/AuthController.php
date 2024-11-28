<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login()
    {
        return view('login');
    }

    function prosesLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'Pemilik') {
                return redirect()->intended('/pemilik/dashboard');
            } elseif ($user->role === 'Admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                return "";
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function register()
    {
        return view('register');
    }

    public function prosesRegister(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['role'] = 'Pemilik';

        User::create($data);
        return redirect(url('login'))->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
