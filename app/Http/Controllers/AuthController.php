<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    // ========== Tampilkan halaman login ==========
    public function showLogin()
    {
        // Kalau sudah login, langsung redirect
        if (session('token')) {
            $role = session('user.role');
            return $role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user-meeting');
        }

        return view('auth.login');
    }

    // ========== Proses login ==========
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $response = Http::post(env('API_URL') . '/login', [
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        if ($response->failed()) {
            return back()->withErrors([
                'message' => $response->json('message') ?? 'Email atau password salah.'
            ])->withInput($request->only('email'));
        }

        $data = $response->json();

        // Simpan token & data user di session
        session([
            'token' => $data['token'],
            'user'  => $data['user'],
        ]);

        // Redirect berdasarkan role
        if ($data['user']['role'] === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user-meeting');
    }

    // ========== Logout ==========
    public function logout()
    {
        Http::withToken(session('token'))
            ->post(env('API_URL') . '/logout');

        session()->flush();

        return redirect()->route('login');
    }
}