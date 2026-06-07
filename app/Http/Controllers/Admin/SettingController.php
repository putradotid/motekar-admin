<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SettingController extends Controller
{
    private function apiUrl() { return config('api.url'); }
    private function token()  { return session('token'); }

    public function index()
    {
        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/settings');

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        $settings = $response->json();

        return view('admin.setting', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = [
            'company_name'     => $request->company_name,
            'company_email'    => $request->company_email,
            'company_phone'    => $request->company_phone,
            'company_address'  => $request->company_address,
            'company_whatsapp' => $request->company_whatsapp,
            'office_open'      => $request->office_open,
            'office_close'     => $request->office_close,
            'facebook_url'     => $request->facebook_url,
            'instagram_url'    => $request->instagram_url,
            'youtube_url'      => $request->youtube_url,
        ];

        // handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            
            $response = Http::withToken($this->token())
                ->attach('logo', fopen($file->getRealPath(), 'r'), $file->getClientOriginalName())
                ->post($this->apiUrl() . '/settings', $data);
        } else {
            $response = Http::withToken($this->token())
                ->post($this->apiUrl() . '/settings', $data);
        }

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        if ($response->failed()) {
            return back()->withErrors([
                'message' => $response->json('message') ?? 'Gagal menyimpan pengaturan.'
            ]);
        }

        return redirect()->route('admin.setting')
                         ->with('success', 'Pengaturan berhasil disimpan.');
    }
}
