<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ManageUserController extends Controller
{
    private function apiUrl()
    {
        return config('api.url');
    }

    private function token()
    {
        return session('token');
    }

    public function showCreate()
    {
        return view('auth.registerAdmin');
    }

    public function adminList(Request $request)
    {
        return $this->getUsers($request, 'admin', 'admin.manageAdmin');
    }
    
    public function userList(Request $request)
    {
        return $this->getUsers($request, 'user', 'admin.manageUser');
    }

    private function getUsers(Request $request, string $role, string $view)
    {
        $page = $request->get('page', 1);
        $search = $request->get('search', '');
        $status = $request->get('status', '');

        $response = Http::withToken($this->token())
            ->get($this->apiUrl() . '/admin/users', [
                'page' => $page,
                'search' => $search,
                'status' => $status,
                'role' => $role,
            ]);
        
        if ($response->status() === 401) {
            session()->flush();
            return redirect()->route('login');
        }

        if ($response->failed()) {
            return back()->withErrors(['message' => 'Gagal mengambil data user.']);
        }

        $users = $response->json();

        return view($view, compact('users', 'search', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);
        
        $response = Http::withToken($this->token())
            ->post($this->apiUrl() . '/admin/users', [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
            ]);

            if ($response->status() ===401) {
                session()->flush();
                return redirect()->route('login');
            }

            if ($response->failed()) {
                return back()->withErrors([
                    'message' => $response->json('messsage') ?? 'Gagal membuat akun.'
                ])->withInput($request->except('password', 'password_confimation'));
            }

            return redirect()->route('admin.manage.admin')->with('success', 'Akun berhasil dibuat.');
    }

    // suspend
    public function suspend(int $id)
    {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/users/' . $id . '/suspend');

        if ($response->failed()) {
            return back()->withErrors(['message' => "Gagal suspend user."]);
        }

        return back()->with('success', 'User berhasil disuspend.');
    }
    
    // suspend
    public function active(int $id)
    {
        $response = Http::withToken($this->token())
            ->put($this->apiUrl() . '/admin/users/' . $id . '/active');

        if ($response->failed()) {
            return back()->withErrors(['message' => "Gagal mengaktifkan user."]);
        }

        return back()->with('success', 'User berhasil diaktifkan.');
    }
}
