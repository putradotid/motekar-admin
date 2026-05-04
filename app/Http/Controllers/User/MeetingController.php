<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MeetingController extends Controller
{
    private function apiUrl()
    {
        return env('API_URL');
    }

    private function token()
    {
        return session('token');
    }

    public function index(Request $request)
    {
        $page   = $request->get('page', 1);
        $search = $request->get('search', '');

        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/my-meetings', [
                'page'   => $page,
                'search' => $search,
            ]);

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        if ($response->failed()) {
            return back()->withErrors(['message' => 'Gagal mengambil data meeting.']);
        }

        $meetings = $response->json();

        return view('user.meeting', compact('meetings', 'search'));
    }

    public function cancel(int $id)
    {
        $response = Http::withToken($this->token())
            ->delete($this->apiUrl() . '/my-meetings/' . $id);

        if ($response->failed()) {
            return back()->withErrors(['message' => 'Gagal membatalkan meeting.']);
        }

        return redirect()->route('user-meeting')
                         ->with('success', 'Meeting berhasil dibatalkan.');
    }
}