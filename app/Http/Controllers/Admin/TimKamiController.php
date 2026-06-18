<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TimKamiController extends Controller
{
    private function apiUrl() { return config('api.url'); }
    private function token()  { return session('token'); }

    public function index()
    {
        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/tim-kami');

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        $data = $response->successful() ? ($response->json() ?? []) : [];

        return view('admin.timkami', [
            'hero'           => $data['hero'] ?? null,
            'leaders'        => $data['leaders'] ?? [],
            'client_support' => $data['client_support'] ?? [],
            'developers'     => $data['developers'] ?? [],
        ]);
    }

    // ==================== HERO ====================
    public function storeHero(Request $request)
    {
        $response = Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/tim-kami/hero', [
                'title'          => $request->title,
                'description'    => $request->description,
                'section2_label' => $request->section2_label,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.tim-kami')
                             ->with('error', 'Gagal menyimpan: ' . $response->body());
        }

        return redirect()->route('admin.tim-kami')
                         ->with('success', 'Hero berhasil disimpan.');
    }

    public function updateHero(Request $request, int $id)
    {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/tim-kami/hero/' . $id, [
                'title'          => $request->title,
                'description'    => $request->description,
                'section2_label' => $request->section2_label,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.tim-kami')
                             ->with('error', 'Gagal update: ' . $response->body());
        }

        return redirect()->route('admin.tim-kami')
                         ->with('success', 'Hero berhasil diupdate.');
    }

    // ==================== TEAM MEMBERS ====================
    public function storeMember(Request $request)
    {
        $response = Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/tim-kami/members', [
                'photo'       => $request->photo,
                'name'        => $request->name,
                'designation' => $request->designation,
                'division'    => $request->division,
                'order'       => $request->order ?? 0,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.tim-kami')
                             ->with('error', 'Gagal menambah member: ' . $response->body());
        }

        return redirect()->route('admin.tim-kami')
                         ->with('success', 'Team member berhasil ditambahkan.');
    }

    public function updateMember(Request $request, int $id)
    {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/tim-kami/members/' . $id, [
                'photo'       => $request->photo,
                'name'        => $request->name,
                'designation' => $request->designation,
                'division'    => $request->division,
                'order'       => $request->order ?? 0,
                'is_active'   => $request->has('is_active') ? 1 : 0,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.tim-kami')
                             ->with('error', 'Gagal update member: ' . $response->body());
        }

        return redirect()->route('admin.tim-kami')
                         ->with('success', 'Team member berhasil diupdate.');
    }

    public function destroyMember(int $id)
    {
        Http::withToken($this->token())
            ->delete($this->apiUrl() . '/admin/tim-kami/members/' . $id);

        return redirect()->route('admin.tim-kami')
                         ->with('success', 'Team member berhasil dihapus.');
    }
}