<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    private function apiUrl() { return config('api.url'); }
    private function token()  { return session('token'); }

    public function index(Request $request)
    {
        $status = $request->get('status', '');
        $search = $request->get('search', '');
        $page   = $request->get('page', 1);

        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/contacts', [
                'status'   => $status,
                'search'   => $search,
                'page'     => $page,
                'per_page' => 10,
            ]);

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        $contacts = $response->json();

        return view('admin.contacts', compact('contacts', 'status', 'search'));
    }

    public function show(int $id)
    {
        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/contacts/' . $id);

        if ($response->failed()) {
            return back()->withErrors(['message' => 'Pesan tidak ditemukan.']);
        }

        $contact = $response->json();

        return view('admin.contactDetail', compact('contact'));
    }

    public function updateStatus(Request $request, int $id)
    {
        Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/contacts/' . $id . '/status', [
                'status' => $request->status,
            ]);

        return back()->with('success', 'Status berhasil diupdate.');
    }

    public function destroy(int $id)
    {
        Http::withToken($this->token())
            ->delete($this->apiUrl() . '/admin/contacts/' . $id);

        return redirect()->route('admin.contacts')
                         ->with('success', 'Pesan berhasil dihapus.');
    }
}
