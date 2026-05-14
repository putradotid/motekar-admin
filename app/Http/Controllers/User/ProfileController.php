<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    private function apiUrl()
    {
        return config('api.url');
    }

    private function token()
    {
        return session('token');
    }

    public function index()
    {
        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/profile');

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        $profile = $response->json();

        return view('user.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/profile', [
                'name'  => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        if ($response->failed()) {
            return back()->withErrors([
                'message' => $response->json('message') ?? 'Gagal update profile.'
            ])->withInput();
        }

        session(['user' => $response->json('user')]);

        return redirect()->route('user-profile')
                         ->with('success', 'Profile berhasil diupdate.');
    }
}
