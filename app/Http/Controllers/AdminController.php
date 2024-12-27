<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Poli;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil data untuk total dokter, pasien, dan poli
        $dokterCount = Dokter::count();
        $pasienCount = Pasien::count();
        $polisCount = Poli::count();
    
        // Ambil daftar dokter dan pasien
        $dokters = Dokter::all();
        $pasiens = Pasien::all();
    
        // Kirim data ke view
        return view('admin.dashboard', compact('dokterCount', 'pasienCount', 'polisCount', 'dokters', 'pasiens'));
    }
    

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
{

    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // Cek validitas username dan password
    if ($request->username == 'admin' && $request->password == 'admin') {
        session(['admin_logged_in' => true]); // Menyimpan status login admin
        
        return redirect()->route('admin.dashboard'); // Arahkan ke dashboard admin
    } else {
       
        return redirect()->route('admin.login')->with('error', 'Username atau password salah.');
    }
}

    

    

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('login');
    }

 

}