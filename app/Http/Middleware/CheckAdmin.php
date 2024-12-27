<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Log;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('Middleware CheckAdmin diakses');

        if (!session('admin_logged_in')) {
            Log::warning('Admin belum login.');
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        Log::info('Admin terautentikasi.');
        return $next($request);
    }
}
