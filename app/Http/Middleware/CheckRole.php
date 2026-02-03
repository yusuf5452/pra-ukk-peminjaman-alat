<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // 2. Cek apakah role user saat ini ada di dalam daftar role yang diperbolehkan
        // $roles adalah array argumen yang dikirim dari route, misal ['admin', 'petugas']
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // 3. Jika login tapi role tidak sesuai, tampilkan 403 Forbidden
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}