<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Str;


class TentangKamiController extends Controller
{
    private function apiUrl() { return config('api.url'); }
    private function token()  { return session('token'); }

    public function index()
    {
        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/tentang-kami');

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        $page = $response->successful() ? $response->json() : null;

        return view('admin.tentangkami', compact('page'));
    }

    public function store(Request $request)
    {
        $response = Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/tentang-kami', $this->payload($request));

        if (!$response->successful()) {
            return redirect()->route('admin.tentang-kami')
                             ->with('error', 'Gagal menyimpan: ' . $response->body());
        }

        return redirect()->route('admin.tentang-kami')
                         ->with('success', 'Halaman Tentang Kami berhasil disimpan.');
    }

    public function update(Request $request, int $id)
    {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/tentang-kami/' . $id, $this->payload($request));

        if (!$response->successful()) {
            return redirect()->route('admin.tentang-kami')
                             ->with('error', 'Gagal update: ' . $response->body());
        }

        return redirect()->route('admin.tentang-kami')
                         ->with('success', 'Halaman Tentang Kami berhasil diupdate.');
    }

    private function payload(Request $request): array
    {
        return [
            'title'               => $request->title,
            'description'         => $request->description,
            'vision'              => $request->vision,
            'mission'             => $request->mission,
            'visi_misi_image'     => $request->visi_misi_image,
            'founder_title'       => $request->founder_title,
            'founder_description' => $request->founder_description,
            'founder_name'        => $request->founder_name,
            'founder_position'    => $request->founder_position,
            'founder_image'       => $request->founder_image,
        ];
    }
}