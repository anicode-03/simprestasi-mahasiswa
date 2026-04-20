<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('mahasiswa')->check()) {
            return redirect('/mahasiswa/login')->with('error', 'Silakan login sebagai mahasiswa');
        }

        return $next($request);
    }
}