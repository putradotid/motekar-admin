<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MediaController extends Controller
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
        $category = $request->get('category', '');
        $page = $request->get('page', 1);

        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/media', [
                'category' => $category,
                'page' => $page,
                'per_page' => 20,
            ]);

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        $media = $response->json();
        
        return view('admin.media', compact('media', 'category'));
    }

    // upload media
    public function store(Request $request)
    {
        $request->validate([
            'file'     => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:3072',
            'category' => 'required|in:image,icon,team,clients,background',
        ]);

        $response = Http::withToken($this->token())
            ->attach(
                'file',
                file_get_contents($request->file('file')),
                $request->file('file')->getClientOriginalName()
            )
            ->post($this->apiUrl() . '/admin/media', [
                'category' => $request->category,
            ]);

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        if ($response->failed()) {
            return back()->withErrors(['message' => 'Gagal mengunggah media.']);
        }

        return redirect()->route('admin.media', ['category' => $request->category])->with('success', 'Media berhasil diunggah.');
    }

    // delete media
    public function destroy(int $id)
    {
        $response = Http::withToken($this->token())
            ->delete($this->apiUrl() . '/admin/media/' . $id);

        if ($response->failed()) {
            return back()->withErrors(['message' => 'Gagal menghapus media.']);
        }

        return back()->with('success', 'Media berhasil dihapus.');
    }

    // detail gambar
    public function show(int $id)
    {
        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/media/' . $id);

        if ($response->failed()) {
            return back()->withErrors(['message' => 'Media tidak ditemukan.']);
        }

        $media = $response->json();

        return view('admin.mediaDetail', compact('media'));
    }
}
