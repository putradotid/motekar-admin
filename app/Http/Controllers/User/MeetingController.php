<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MeetingController extends Controller
{
    private function apiUrl()
    {
        return config('api.url');
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

        // data stats
        $statsResponse = Http::withToken($this->token())
        ->get($this->apiUrl() . '/my-meetings/stats');

        $meetings = $response->json();
        $stats    = $statsResponse->json();

        return view('user.meeting', compact('meetings', 'stats', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required'
        ]);

        // menggabungkan waktu
        $datetime = $request->date . ' ' . $request->time . ':00';

        $response = Http::withToken($this->token())
            ->post($this->apiUrl() . '/meetings' ,[
                'title'       => $request->title,
                'description' => $request->description,
                'date'        => $datetime,
            ]);
        
            if ($response->status() === 401) {
                session()->flush();
                return redirect()->route('login');
            }
            
            if ($response->failed()) {
                return back()->withErrors([
                    'message' => $response->json('message') ?? 'Gagal Mengajukan meeting.'
                ])->withInput();
            }

            return redirect()->route('user-meeting')
                ->with('success', 'Meeting berhasil diajukan!');
            
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