<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestimoniController extends Controller
{
    private function apiUrl() { return config('api.url'); }
    private function token()  { return session('token'); }

    public function index()
    {
        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/testimoni');

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        $data = $response->successful() ? ($response->json() ?? []) : [];

        return view('admin.testimoni', [
            'hero'         => $data['hero'] ?? null,
            'featured_customers' => $data['featured_customers'] ?? [],
            'testimonials' => $data['testimonials'] ?? [],
            'partners'     => $data['partners'] ?? [],
        ]);
    }

    // ==================== HERO ====================
    public function storeHero(Request $request)
    {
        $response = Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/testimoni/hero', [
                'title'       => $request->title,
                'description' => $request->description,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.testimoni')
                             ->with('error', 'Gagal menyimpan: ' . $response->body());
        }

        return redirect()->route('admin.testimoni')
                         ->with('success', 'Hero berhasil disimpan.');
    }

    public function updateHero(Request $request, int $id)
    {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/testimoni/hero/' . $id, [
                'title'       => $request->title,
                'description' => $request->description,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.testimoni')
                             ->with('error', 'Gagal update: ' . $response->body());
        }

        return redirect()->route('admin.testimoni')
                         ->with('success', 'Hero berhasil diupdate.');
    }

    // ==================== TESTIMONIALS ====================
    public function storeTestimonial(Request $request)
    {
        $response = Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/testimoni/testimonials', [
                'photo'         => $request->photo,
                'title'         => $request->title,
                'description'   => $request->description,
                'name'          => $request->name,
                'social_handle' => $request->social_handle,
                'order'         => $request->order ?? 0,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.testimoni')
                             ->with('error', 'Gagal menambah testimoni: ' . $response->body());
        }

        return redirect()->route('admin.testimoni')
                         ->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function updateTestimonial(Request $request, int $id)
    {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/testimoni/testimonials/' . $id, [
                'photo'         => $request->photo,
                'title'         => $request->title,
                'description'   => $request->description,
                'name'          => $request->name,
                'social_handle' => $request->social_handle,
                'order'         => $request->order ?? 0,
                'is_active'     => $request->has('is_active') ? 1 : 0,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.testimoni')
                             ->with('error', 'Gagal update testimoni: ' . $response->body());
        }

        return redirect()->route('admin.testimoni')
                         ->with('success', 'Testimoni berhasil diupdate.');
    }

    public function destroyTestimonial(int $id)
    {
        Http::withToken($this->token())
            ->delete($this->apiUrl() . '/admin/testimoni/testimonials/' . $id);

        return redirect()->route('admin.testimoni')
                         ->with('success', 'Testimoni berhasil dihapus.');
    }

    // ==================== CLIENT & PARTNERS ====================
    public function storePartner(Request $request)
    {
        $response = Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/testimoni/partners', [
                'name'       => $request->name,
                'logo_image' => $request->logo_image,
                'order'      => $request->order ?? 0,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.testimoni')
                             ->with('error', 'Gagal menambah partner: ' . $response->body());
        }

        return redirect()->route('admin.testimoni')
                         ->with('success', 'Client/Partner berhasil ditambahkan.');
    }

    public function updatePartner(Request $request, int $id)
    {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/testimoni/partners/' . $id, [
                'name'       => $request->name,
                'logo_image' => $request->logo_image,
                'order'      => $request->order ?? 0,
                'is_active'  => $request->has('is_active') ? 1 : 0,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.testimoni')
                             ->with('error', 'Gagal update partner: ' . $response->body());
        }

        return redirect()->route('admin.testimoni')
                         ->with('success', 'Client/Partner berhasil diupdate.');
    }

    public function destroyPartner(int $id)
    {
        Http::withToken($this->token())
            ->delete($this->apiUrl() . '/admin/testimoni/partners/' . $id);

        return redirect()->route('admin.testimoni')
                         ->with('success', 'Client/Partner berhasil dihapus.');
    }

    // ==================== FEATURED CUSTOMERS ====================
    public function storeFeaturedCustomer(Request $request)
    {
        $response = Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/testimoni/featured-customers', [
                'photo'       => $request->photo,
                'name'        => $request->name,
                'designation' => $request->designation,
                'order'       => $request->order ?? 0,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.testimoni')
                            ->with('error', 'Gagal menambah: ' . $response->body());
        }

        return redirect()->route('admin.testimoni')
                        ->with('success', 'Featured customer berhasil ditambahkan.');
    }

    public function updateFeaturedCustomer(Request $request, int $id)
    {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/testimoni/featured-customers/' . $id, [
                'photo'       => $request->photo,
                'name'        => $request->name,
                'designation' => $request->designation,
                'order'       => $request->order ?? 0,
                'is_active'   => $request->has('is_active') ? 1 : 0,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.testimoni')
                            ->with('error', 'Gagal update: ' . $response->body());
        }

        return redirect()->route('admin.testimoni')
                        ->with('success', 'Featured customer berhasil diupdate.');
    }

    public function destroyFeaturedCustomer(int $id)
    {
        Http::withToken($this->token())
            ->delete($this->apiUrl() . '/admin/testimoni/featured-customers/' . $id);

        return redirect()->route('admin.testimoni')
                        ->with('success', 'Featured customer berhasil dihapus.');
    }
}