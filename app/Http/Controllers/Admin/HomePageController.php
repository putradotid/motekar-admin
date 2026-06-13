<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomePageController extends Controller
{
    private function apiUrl() { return config('api.url'); }
    private function token()  { return session('token'); }

    public function index()
    {
        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/hero-slides');

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        $slides = $response->successful() ? ($response->json() ?? []) : [];

        return view('admin.homepage', compact('slides'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'background_type'  => 'required|in:color,image',
            'background_value' => 'required|string',
        ]);

        Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/hero-slides', [
                'title'            => $request->title,
                'description'      => $request->description,
                'button_text'      => $request->button_text,
                'button_url'       => $request->button_url,
                'background_type'  => $request->background_type,
                'background_value' => $request->background_value,
                'order'            => $request->order ?? 0,
                'is_active'        => 1,
            ]);

        return redirect()->route('admin.homepage')
                         ->with('success', 'Hero section berhasil ditambahkan.');
    }

    public function update(Request $request, int $id)
    {
        Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/hero-slides/' . $id, [
                'title'            => $request->title,
                'description'      => $request->description,
                'button_text'      => $request->button_text,
                'button_url'       => $request->button_url,
                'background_type'  => $request->background_type,
                'background_value' => $request->background_value,
                'is_active'        => $request->has('is_active') ? 1 : 0,
            ]);

        return redirect()->route('admin.homepage')
                         ->with('success', 'Hero section berhasil disimpan.');
    }

    public function destroy(int $id)
    {
        Http::withToken($this->token())
            ->delete($this->apiUrl() . '/admin/hero-slides/' . $id);

        return redirect()->route('admin.homepage')
                         ->with('success', 'Hero section berhasil dihapus.');
    }
}