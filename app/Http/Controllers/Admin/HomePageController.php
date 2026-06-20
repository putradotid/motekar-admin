<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomePageController extends Controller
{
    private function apiUrl() { return config('api.url'); }
    private function token()  { return session('token'); }

    // Fetch semua data homepage
    public function index()
    {
        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/homepage');

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        $data = $response->successful() ? ($response->json() ?? []) : [];
        
        return view('admin.homepage', [
            'slides'   => $data['hero'] ?? [],
            'about'    => $data['about'] ?? null,
            'stats'    => $data['stats'] ?? [], 
            'service_section' => $data['service_section'] ?? null,
            'cta'      => $data['cta'] ?? null,
        ]);
    }

    // ==================== HERO ====================
    public function storeHero(Request $request)
    {
        Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/homepage/hero', $request->all());

        return redirect()->route('admin.homepage')
                         ->with('success', 'Hero section berhasil ditambahkan.');
    }

    public function updateHero(Request $request, int $id)
    {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/homepage/hero/' . $id, [
                'title'            => $request->title,
                'description'      => $request->description,
                'button_text'      => $request->button_text,
                'button_url'       => $request->button_url,
                'icon_url'         => $request->icon_url, 
                'background_type'  => $request->background_type,
                'background_value' => $request->background_value,
                'is_active'        => $request->has('is_active') ? 1 : 0,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.homepage')
                            ->with('error', 'Gagal update: ' . $response->body());
        }

        return redirect()->route('admin.homepage')
                        ->with('success', 'Hero section berhasil diupdate.');
    }

    public function destroyHero(Request $request, int $id)
    {
        Http::withToken($this->token())
            ->delete($this->apiUrl() . '/admin/homepage/hero/' . $id);

        return redirect()->route('admin.homepage')
                         ->with('success', 'Hero section berhasil dihapus.');
    }

    // ==================== ABOUT ====================
    public function storeAbout(Request $request)
    {
        Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/homepage/about', $request->all());

        return redirect()->route('admin.homepage')
                         ->with('success', 'About page berhasil disimpan.');
    }

    public function updateAbout(Request $request, int $id)
    {
        Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/homepage/about/' . $id, [
                'title'       => $request->title,
                'description' => $request->description,
                'image_url'   => $request->image_url,
                'image_1'     => $request->image_1,
                'image_2'     => $request->image_2,
                'image_3'     => $request->image_3,
                'image_4'     => $request->image_4,
                'image_5'     => $request->image_5,
                'image_6'     => $request->image_6,
            ]);

        return redirect()->route('admin.homepage')
                        ->with('success', 'About page berhasil diupdate.');
    }

    // ==================== STATS ====================
    public function storeStats(Request $request)
    {
        Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/homepage/stats', $request->all());

        return redirect()->route('admin.homepage')
                         ->with('success', 'Stats page berhasil disimpan.');
    }

    public function updateStats(Request $request, int $id)
    {
        Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/homepage/stats/' . $id, $request->all());

        return redirect()->route('admin.homepage')
                         ->with('success', 'Stats page berhasil diupdate.');
    }

    // ==================== SERVICES ====================
    public function storeService(Request $request)
    {
        Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/homepage/services', [
                'name'        => $request->name,
                'description' => $request->description,
                'icon_url'    => $request->icon_url,
                'image_1'     => $request->image_1,
                'image_2'     => $request->image_2,
                'image_3'     => $request->image_3,
                'image_4'     => $request->image_4,
                'order'       => $request->order ?? 0,
            ]);

        return redirect()->route('admin.homepage')
                        ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function updateService(Request $request, int $id)
    {
        Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/homepage/services/' . $id, [
                'name'        => $request->name,
                'description' => $request->description,
                'icon_url'    => $request->icon_url,
                'image_1'     => $request->image_1,
                'image_2'     => $request->image_2,
                'image_3'     => $request->image_3,
                'image_4'     => $request->image_4,
                'order'       => $request->order ?? 0,
                'is_active'   => $request->has('is_active') ? 1 : 0,
            ]);

        return redirect()->route('admin.homepage')
                        ->with('success', 'Layanan berhasil diupdate.');
    }

    public function destroyService(Request $request, int $id)
    {
        Http::withToken($this->token())
            ->delete($this->apiUrl() . '/admin/homepage/services/' . $id);

        return redirect()->route('admin.homepage')
                         ->with('success', 'Layanan berhasil dihapus.');
    }

    // ==================== CTA ====================
    public function storeCta(Request $request)
    {
        Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/homepage/cta', $request->all());

        return redirect()->route('admin.homepage')
                         ->with('success', 'Call to Action berhasil disimpan.');
    }

    public function updateCta(Request $request, int $id)
    {
        Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/homepage/cta/' . $id, $request->all());

        return redirect()->route('admin.homepage')
                         ->with('success', 'Call to Action berhasil diupdate.');
    }
}