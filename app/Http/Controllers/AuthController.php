<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Auth::login($user); // langsung login setelah register

        return redirect()->route('home');
    }

    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Jika admin → dashboard
        if ($user->role === 'admin') {
            return redirect()->route('dashboard')->with('success', 'Selamat datang, Admin!');
        }

        // Jika user biasa → home
        return redirect()->route('home')->with('success', 'Selamat datang kembali!');
    }

    return back()->withErrors(['email' => 'Email atau password salah.']);
    }


    // Tampilkan halaman home
    public function home()
    {
        $user = Auth::user();  // Mengambil data user yang sedang login
        return view('home', compact('user'));  // Mengirim data user ke view 'home'
    }

    // Logout
    public function logout()
    {
    Auth::logout();

    // Hapus session supaya benar-benar keluar
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    // Arahkan ke halaman login setelah logout
    return redirect()->route('login')->with('success', 'Anda telah logout.');
    }

}
