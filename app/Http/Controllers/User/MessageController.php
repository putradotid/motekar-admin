<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessageController extends Controller
{
    private function apiUrl()
    {
        return config('api.url');
    }

    private function token()
    {
        return session('token');
    }

    // Halaman utama chat — load list meeting + chat pertama
    public function index(Request $request)
    {
        $meetingId = $request->get('meeting');

        $meetingsResponse = Http::withToken($this->token())
            ->get($this->apiUrl() . '/messages');

        if ($meetingsResponse->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        $meetings      = $meetingsResponse->json() ?? [];
        $messages      = [];
        $activeMeeting = null;

        if ($meetingId && !empty($meetings)) {
            $messagesResponse = Http::withToken($this->token())
                ->get($this->apiUrl() . '/messages/' . $meetingId);

            $messages      = $messagesResponse->successful() ? ($messagesResponse->json() ?? []) : [];
            $activeMeeting = collect($meetings)->firstWhere('id', (int) $meetingId);

        } elseif (!empty($meetings)) {
            $activeMeeting    = $meetings[0];
            $messagesResponse = Http::withToken($this->token())
                ->get($this->apiUrl() . '/messages/' . $activeMeeting['id']);

            $messages = $messagesResponse->successful() ? ($messagesResponse->json() ?? []) : [];
        }

        return view('user.message', compact('meetings', 'messages', 'activeMeeting'));
    }

    // Kirim pesan
    public function store(Request $request, int $meetingId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Http::withToken($this->token())
            ->post($this->apiUrl() . '/messages/' . $meetingId, [
                'message' => $request->message,
            ]);

        return redirect()->route('user-message', ['meeting' => $meetingId]);
    }
}