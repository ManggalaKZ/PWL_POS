<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) { // jika sudah login, maka redirect ke halaman home
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        // Pastikan permintaan berbentuk AJAX atau JSON
        if ($request->ajax() || $request->wantsJson()) {
            // Validasi input
            $credentials = $request->validate([
                'username' => 'required|string|min:4|max:20',
                'password' => 'required|string|min:6|max:20'
            ]);

            // Proses autentikasi
            if (Auth::guard('web')->attempt($credentials)) {
                // Regenerasi session untuk keamanan
                $request->session()->regenerate();

                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/') // Ubah ke URL tujuan setelah login
                ]);
            }

            // Jika autentikasi gagal
            return response()->json([
                'status' => false,
                'message' => 'Login Gagal, username atau password salah.',
                'msgField' => [
                    'username' => ['Username atau password salah.']
                ]
            ]);
        }

        // Jika bukan AJAX, redirect ke halaman login
        return redirect()->route('login')->withErrors([
            'login' => 'Login Gagal. Silakan coba lagi.'
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
