<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProdukLayananController extends Controller
{
    private function apiUrl() { return config('api.url'); }
    private function token()  { return session('token'); }

    public function index()
    {
        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/produk-layanan');

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        $data = $response->successful() ? ($response->json() ?? []) : [];

        return view('admin.produklayanan', [
            'hero'     => $data['hero'] ?? null,
            'products' => $data['products'] ?? [],
            'services' => $data['services'] ?? [],
        ]);
    }

    // ==================== HERO ====================
    public function storeHero(Request $request)
    {
        $response = Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/produk-layanan/hero', [
                'title'       => $request->title,
                'description' => $request->description,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.produk-layanan')
                             ->with('error', 'Gagal menyimpan: ' . $response->body());
        }

        return redirect()->route('admin.produk-layanan')
                         ->with('success', 'Hero berhasil disimpan.');
    }

    public function updateHero(Request $request, int $id)
    {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/produk-layanan/hero/' . $id, [
                'title'       => $request->title,
                'description' => $request->description,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.produk-layanan')
                             ->with('error', 'Gagal update: ' . $response->body());
        }

        return redirect()->route('admin.produk-layanan')
                         ->with('success', 'Hero berhasil diupdate.');
    }

    // ==================== PRODUCTS ====================
    public function storeProduct(Request $request)
    {
        $response = Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/produk-layanan/products', [
                'title'              => $request->title,
                'image_url'          => $request->image_url,
                'description'        => $request->description,
                'detail_description' => $request->detail_description,
                'order'              => $request->order ?? 0,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.produk-layanan')
                             ->with('error', 'Gagal menambah produk: ' . $response->body());
        }

        return redirect()->route('admin.produk-layanan')
                         ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function updateProduct(Request $request, int $id)
    {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/produk-layanan/products/' . $id, [
                'title'              => $request->title,
                'image_url'          => $request->image_url,
                'description'        => $request->description,
                'detail_description' => $request->detail_description,
                'order'              => $request->order ?? 0,
                'is_active'          => $request->has('is_active') ? 1 : 0,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.produk-layanan')
                             ->with('error', 'Gagal update produk: ' . $response->body());
        }

        return redirect()->route('admin.produk-layanan')
                         ->with('success', 'Produk berhasil diupdate.');
    }

    public function destroyProduct(int $id)
    {
        Http::withToken($this->token())
            ->delete($this->apiUrl() . '/admin/produk-layanan/products/' . $id);

        return redirect()->route('admin.produk-layanan')
                         ->with('success', 'Produk berhasil dihapus.');
    }

    // ==================== SERVICES ====================
    public function storeService(Request $request)
    {
        $response = Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/produk-layanan/services', [
                'title'              => $request->title,
                'icon_url'           => $request->icon_url,
                'description'        => $request->description,
                'detail_description' => $request->detail_description,
                'order'              => $request->order ?? 0,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.produk-layanan')
                             ->with('error', 'Gagal menambah layanan: ' . $response->body());
        }

        return redirect()->route('admin.produk-layanan')
                         ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function updateService(Request $request, int $id)
    {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/produk-layanan/services/' . $id, [
                'title'              => $request->title,
                'icon_url'           => $request->icon_url,
                'description'        => $request->description,
                'detail_description' => $request->detail_description,
                'order'              => $request->order ?? 0,
                'is_active'          => $request->has('is_active') ? 1 : 0,
            ]);

        if (!$response->successful()) {
            return redirect()->route('admin.produk-layanan')
                             ->with('error', 'Gagal update layanan: ' . $response->body());
        }

        return redirect()->route('admin.produk-layanan')
                         ->with('success', 'Layanan berhasil diupdate.');
    }

    public function destroyService(int $id)
    {
        Http::withToken($this->token())
            ->delete($this->apiUrl() . '/admin/produk-layanan/services/' . $id);

        return redirect()->route('admin.produk-layanan')
                         ->with('success', 'Layanan berhasil dihapus.');
    }
}