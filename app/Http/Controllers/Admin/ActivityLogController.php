<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActivityLogController extends Controller
{
    private function apiUrl() { return config('api.url'); }
    private function token()  { return session('token'); }

    public function index(Request $request)
    {
        $module = $request->get('module', '');
        $page   = $request->get('page', 1);

        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/activity-logs', [
                'module'   => $module,
                'page'     => $page,
                'per_page' => 15,
            ]);

        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        $logs = $response->json();

        return view('admin.activityLog', compact('logs', 'module'));
    }
}
