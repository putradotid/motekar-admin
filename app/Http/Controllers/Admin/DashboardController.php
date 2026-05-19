<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    private function apiUrl()
    {
        return config('api.url');
    }

    private function token()
    {
        return session('token');
    }

    public function index()
    {
        $statsResponse = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/statistics');

        $recentResponse = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/meetings/recent');

        $usersResponse = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/users', [
                'role' => 'user',
                'per_page' => 1,
            ]);
        
        $adminsResponse = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/users', [
                'role' => 'admin',
                'per_page' => 1,
            ]);
        
        $monthlyResponse = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/meetings/monthly');
        
        if ($statsResponse->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }
        
        $stats   = $statsResponse->json();
        $recent  = $recentResponse->json();
        $users   = $usersResponse->json();
        $admins  = $adminsResponse->json();
        $monthly  = $monthlyResponse->json();

        return view('admin.dashboard', compact('stats', 'recent', 'users', 'admins', 'monthly'));
    }
}
