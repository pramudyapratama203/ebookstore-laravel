<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login
    public function login(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek validasi
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            // Cek role user ke arah dashboard sesuai role
            if (Auth::user()->isBuyer()) {
                return redirect()->route('home.buyer');
            }

            if (Auth::user()->isSeller()) {
                return redirect()->route('home.seller');
            }

            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Menampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Register
    public function register(Request $request)
    {
        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:buyer,seller',
        ]);

        // Buat user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'joined' => now(),
        ]);

        // Login user
        Auth::login($user);

        if ($user->isBuyer()) {
            return redirect()->route('home.buyer')->with('success', 'Akun berhasil dibuat. Silahkan login');
        }

        if ($user->isSeller()) {
            return redirect()->route('home.seller')->with('success', 'Akun berhasil dibuat. Silahkan login');
        }

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silahkan login');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout');
    }
}
