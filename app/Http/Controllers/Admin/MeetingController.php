<?php

namespace App\Http\Controllers\Admin;

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
        $page = $request->get('page', 1);
        $search = $request->get('search', '');
        $date = $request->get('date', '');
        $tab = $request->get('tab', 'all');
        $status = $tab !== 'all' ? $tab : '';
        $filterStatus = $status ?: ($tab !== 'all' ? $tab : '');

        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/meetings', [
                'page' => $page,
                'search' => $search,
                'status' => $filterStatus,
                'date' => $date,
            ]);
        
        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        if ($response->failed()) {
            return back()->withErrors(['message' => 'Gagal mengambil data meeting.']);
        }

        $statsResponse = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/statistics');

        $meetings = $response->json();
        $stats = $statsResponse->json();

        return view('admin.meetingRequest', compact('meetings', 'stats', 'search', 'date', 'tab'));
    }

    public function show(int $id)
    {
        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/meetings/' . $id);
        
        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        if ($response->failed()) {
            return back()->withErrors(['message' => 'Gagal mengambil data meeting.']);
        }

        $meeting = $response->json();

        return view('admin.meetingDetail', compact('meeting'));
    }

   public function approved(int $id) 
   {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/meetings/' . $id . '/approved');
        
        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        if ($response->failed()) {
            return back()->withErrors(['message' => 'Gagal menyetujui meeting.']);
        }

        return redirect()->route('admin.meetings')->with('success', 'Meeting berhasil disetujui');
   }

   public function reject(int $id)
   {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/meetings/' . $id . '/reject');
        
        if ($response->status() === 401) {
                session()->flush();
                return redirect()->route('login');
            }

        if ($response->failed()) {
            return back()->withErrors(['message' => 'Gagal menolak meeting.']);
        }

        return redirect()->route('admin.meetings')
            ->with('success', 'Meeting berhasil ditolak');
   }

   public function done(int $id)
   {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/meetings/' . $id . '/done');

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        if ($response->failed()) {
            return back()->withErrors(['message' => 'Gagal menyelesaikan meeting.']);
        }

        return redirect()->route('admin.meetings')
            ->with('success', 'Meeting berhasil diselesaikan.');
   }
}
