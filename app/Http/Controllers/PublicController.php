<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PublicController extends Controller
{
    private function apiUrl()
    {
        return config('api.url');
    }

    // ==================== BERANDA ====================
    public function beranda()
    {
        try {
            $homepageResponse = Http::timeout(5)->get($this->apiUrl() . '/homepage');
            $homepageData = $homepageResponse->successful() ? ($homepageResponse->json() ?? []) : [];
        } catch (\Exception $e) {
            $homepageData = [];
        }

        try {
            $settingResponse = Http::timeout(5)->get($this->apiUrl() . '/settings');
            $setting = $settingResponse->successful() ? ($settingResponse->json() ?? []) : [];
        } catch (\Exception $e) {
            $setting = [];
        }

        return view('public.beranda', [
            'heroSlides'      => $homepageData['hero'] ?? [],
            'about'           => $homepageData['about'] ?? null,
            'stats'           => $homepageData['stats'] ?? [],
            'service_section' => $homepageData['service_section'] ?? null,
            'cta'             => $homepageData['cta'] ?? null,
            'setting'         => $setting,
        ]);
    }

    // ==================== TENTANG KAMI ====================
    public function tentangKami()
    {
        try {
            $response = Http::timeout(5)->get($this->apiUrl() . '/tentang-kami-page');
            $aboutUs = $response->successful() ? $response->json() : null;
        } catch (\Exception $e) {
            $aboutUs = null;
        }

        try {
            $settingResponse = Http::timeout(5)->get($this->apiUrl() . '/settings');
            $setting = $settingResponse->successful() ? ($settingResponse->json() ?? []) : [];
        } catch (\Exception $e) {
            $setting = [];
        }

        return view('public.tentangkami', [
            'aboutUs' => $aboutUs,
            'setting' => $setting,
            'cta'     => null, // tidak dipakai di halaman ini
        ]);
    }

    // ==================== PRODUK & LAYANAN ====================
    public function produkLayanan()
    {
        try {
            $response = Http::timeout(5)->get($this->apiUrl() . '/produk-layanan-page');
            $data = $response->successful() ? ($response->json() ?? []) : [];
        } catch (\Exception $e) {
            $data = [];
        }

        try {
            $homepageResponse = Http::timeout(5)->get($this->apiUrl() . '/homepage');
            $homepageData = $homepageResponse->successful() ? ($homepageResponse->json() ?? []) : [];
        } catch (\Exception $e) {
            $homepageData = [];
        }

        try {
            $settingResponse = Http::timeout(5)->get($this->apiUrl() . '/settings');
            $setting = $settingResponse->successful() ? ($settingResponse->json() ?? []) : [];
        } catch (\Exception $e) {
            $setting = [];
        }

        return view('public.productlayanan', [
            'plHero'     => $data['hero'] ?? null,
            'plProducts' => $data['products'] ?? [],
            'plServices' => $data['services'] ?? [],
            'cta'        => $homepageData['cta'] ?? null,
            'setting'    => $setting,
        ]);
    }

    // ==================== TESTIMONI ====================
    public function testimoni()
    {
        try {
            $response = Http::timeout(5)->get($this->apiUrl() . '/testimoni-page');
            $data = $response->successful() ? ($response->json() ?? []) : [];
        } catch (\Exception $e) {
            $data = [];
        }

        try {
            $homepageResponse = Http::timeout(5)->get($this->apiUrl() . '/homepage');
            $homepageData = $homepageResponse->successful() ? ($homepageResponse->json() ?? []) : [];
        } catch (\Exception $e) {
            $homepageData = [];
        }

        try {
            $settingResponse = Http::timeout(5)->get($this->apiUrl() . '/settings');
            $setting = $settingResponse->successful() ? ($settingResponse->json() ?? []) : [];
        } catch (\Exception $e) {
            $setting = [];
        }

        return view('public.testimoni', [
            'tHero'             => $data['hero'] ?? null,
            'featuredCustomers' => $data['featured_customers'] ?? [],
            'testimonials'      => $data['testimonials'] ?? [],
            'partners'          => $data['partners'] ?? [],
            'cta'               => $homepageData['cta'] ?? null,
            'setting'           => $setting,
        ]);
    }

    // ==================== TIM KAMI ====================
    public function timKami()
    {
        try {
            $response = Http::timeout(5)->get($this->apiUrl() . '/tim-kami-page');
            $data = $response->successful() ? ($response->json() ?? []) : [];
        } catch (\Exception $e) {
            $data = [];
        }

        try {
            $homepageResponse = Http::timeout(5)->get($this->apiUrl() . '/homepage');
            $homepageData = $homepageResponse->successful() ? ($homepageResponse->json() ?? []) : [];
        } catch (\Exception $e) {
            $homepageData = [];
        }

        try {
            $settingResponse = Http::timeout(5)->get($this->apiUrl() . '/settings');
            $setting = $settingResponse->successful() ? ($settingResponse->json() ?? []) : [];
        } catch (\Exception $e) {
            $setting = [];
        }

        return view('public.timkami', [
            'tkHero'         => $data['hero'] ?? null,
            'tkLeaders'      => $data['leaders'] ?? [],
            'tkClientSupport'=> $data['client_support'] ?? [],
            'tkDevelopers'   => $data['developers'] ?? [],
            'cta'            => $homepageData['cta'] ?? null,
            'setting'        => $setting,
        ]);
    }

    // ==================== KONTAK ====================
    public function kontak()
    {
        try {
            $settingResponse = Http::timeout(5)->get($this->apiUrl() . '/settings');
            $setting = $settingResponse->successful() ? ($settingResponse->json() ?? []) : [];
        } catch (\Exception $e) {
            $setting = [];
        }

        try {
            $homepageResponse = Http::timeout(5)->get($this->apiUrl() . '/homepage');
            $homepageData = $homepageResponse->successful() ? ($homepageResponse->json() ?? []) : [];
        } catch (\Exception $e) {
            $homepageData = [];
        }

        return view('public.kontak', [
            'setting' => $setting,
            'cta'     => $homepageData['cta'] ?? null,
        ]);
    }
}