<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ================= LOGIN =================
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

   if (Auth::attempt($request->only('email', 'password'))) {

    $request->session()->regenerate();

    // TAMBAHAN (biar nambah tiap login)
   /** @var \App\Models\User $user */
     $user = Auth::user();
   $user->login_count = $user->login_count + 1;
   $user->save();

    if (Auth::user()->role == 'petugas') {
        return redirect('/petugas/dashboard');
    } else if (Auth::user()->role == 'kepala') {
        return redirect('/kepala/dashboard');
    } else {
        return redirect('/dashboard');
    }
}

    return back()->with('error', 'Email atau password salah!');
}

    // ================= REGISTER =================
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'anggota'
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat!');
    }


    // ================= LOGOUT =================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
