<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Silakan login terlebih dahulu.');
        }

        // Jika ingin validasi role admin:
        // if (Auth::user()->role !== 'admin') {
        //     return abort(403, 'Akses ditolak.');
        // }

        return $next($request);
    }
}
