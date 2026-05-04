<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;

class CheckAdminToken
{
    public function handle(Request $request, Closure $next)
{
    if (!session('token')) {
        return redirect()->route('login');
    }

    if (session('user.role') !== 'admin') {
        abort(403, 'Akses ditolak.');
    }

    return $next($request);
}
}
