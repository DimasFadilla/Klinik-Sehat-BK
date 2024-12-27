<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; // Import Request
use Illuminate\Http\Response; // Import Response

class DokterAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    // Periksa apakah session dokter ada
    if (!session('dokter_id')) {
        dd('Middleware: Session dokter_id tidak ditemukan.');
        return redirect()->route('dokter.login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
    }
    
    dd('Middleware: Session dokter_id ditemukan.');
    return $next($request);
}
}
