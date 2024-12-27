<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class PasienAuth
{
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('pasien_id')) {
            return redirect()->route('pasien.login');
        }
       
        // if (!Auth::guard('pasien')->check()) {
        //     return redirect()->route('pasien.login');
        // }
        return $next($request);
    }
}
