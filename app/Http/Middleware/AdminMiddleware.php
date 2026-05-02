<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Hapus baris ini setelah tes berhasil:
        // dd($request->user()->role, $role); 

        if ($request->user()->role !== $role) {
            return redirect('/')->with('error', 'Anda bukan admin');
        }

        return $next($request);
    }
}
