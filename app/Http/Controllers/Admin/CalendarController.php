<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CalendarController extends Controller
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
        return view('admin.calendar');
    }

    public function events()
    {
        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/meetings/calendar');

        if ($response->status() === 401) {
            session()->flush();
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json($response->json());
    }
}
