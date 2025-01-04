<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Poli;  // Pastikan model Poli diimpor
use Illuminate\Support\Facades\Auth;
class DokterController extends Controller
{

    public function dashboard()
    {
        // Dapatkan ID dokter dari session
        $dokterId = session('dokter_id');
    
        if (!$dokterId) {
            return redirect()->route('dokter.login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }
    
        // Ambil data dokter dan pasien yang terkait
        $dokter = Dokter::with(['poli', 'daftarPoli.pasien'])->find($dokterId);
    
        if (!$dokter) {
            return redirect()->route('dokter.login')->withErrors(['login' => 'Data dokter tidak ditemukan.']);
        }
    
        // Ambil daftar pasien dari relasi
        $pasiens = $dokter->daftarPoli->map(function ($daftarPoli) {
            return [
                'nama' => $daftarPoli->pasien->nama ?? 'Tidak ada data',
                'alamat' => $daftarPoli->pasien->alamat ?? 'Tidak ada data',
                'jadwal' => $daftarPoli->jadwalPeriksa 
                    ? $daftarPoli->jadwalPeriksa->hari . ' @ ' . $daftarPoli->jadwalPeriksa->jam_mulai . ' - ' . $daftarPoli->jadwalPeriksa->jam_selesai
                    : 'Jadwal tidak tersedia',
                'keluhan' => $daftarPoli->keluhan ?? 'Tidak ada keluhan',
                'obat' => $daftarPoli->periksa && $daftarPoli->periksa->detailPeriksa 
                    ? $daftarPoli->periksa->detailPeriksa->pluck('obat.nama_obat')->join(', ') 
                    : 'Tidak ada obat',
            ];
        });
        
        return view('dokter.dashboard', compact('dokter', 'pasiens'));
    }
    


     // Menampilkan Data Dokter
     public function index()
     {
        $pasiens = Pasien::all(); 
         $dokters = Dokter::with('poli')->get();  // Ambil semua dokter beserta nama poli mereka
         return view('admin.dokter.index', compact('dokters', 'pasiens'));
     }
     public function show(Dokter $dokter)
{
    $dokter->load('poli');
    return view('admin.dokter.show', compact('dokter'));
}

      // Menampilkan form login dokter
    public function showLoginForm()
    {
        return view('auth.dokter-login');  // Pastikan Anda memiliki view untuk form login dokter
    }

    // Proses login dokter (opsional jika ingin menggunakan autentikasi)
    // Proses login dokter
    // Proses login dokter
public function login(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required',
        'alamat' => 'required',
    ]);

    // Cari dokter berdasarkan nama dan alamat (password)
    $dokter = Dokter::where('nama', $request->name)
                    ->where('alamat', $request->alamat) // Gunakan 'alamat' untuk password
                    ->first();

    // Periksa apakah data dokter valid
    if ($dokter) {
        // Simpan data ke session
        session(['dokter_id' => $dokter->id, 'dokter_nama' => $dokter->nama]);
        
        // Redirect ke dashboard dokter
        return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil!');
    }

    // Jika gagal login, kembali ke halaman login dengan pesan error
    return back()->withErrors(['login' => 'Nama atau password salah!'])->withInput();
}

    

    // Logout dokter
    public function logout()
    {
        // Hapus session
        session()->forget(['dokter_id', 'dokter_nama']);

        return redirect()->route('dokter.login')->with('success', 'Logout berhasil!');
    }

    //menambah data  dokter oleh admin
    public function create()
    {
        $polis = Poli::all();
        return view('admin.dokter.create', compact('polis'));
    }

    // menyimoan data
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'id_poli' => 'required|exists:poli,id', // Validasi id_poli
        ]);

        Dokter::create($request->all());
        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil ditambahkan.');
    }

        // edit data dokter oleh admin
    public function edit(Dokter $dokter)
    {
        $polis = Poli::all();
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    //update data dokter oelh admin
    public function update(Request $request, Dokter $dokter)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'no_hp' => 'required|regex:/^[0-9]+$/|min:10|max:15', // Hanya angka, minimal 10, maksimal 15 karakter
        'id_poli' => 'required|exists:poli,id',
    ], [
        'no_hp.regex' => 'Nomor HP hanya boleh berisi angka.', // Pesan error khusus untuk regex
        'no_hp.min' => 'Nomor HP harus minimal 10 digit.',
        'no_hp.max' => 'Nomor HP tidak boleh lebih dari 15 digit.',
    ]);

    // Update data dokter
    $dokter->update([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp,
        'id_poli' => $request->id_poli,
    ]);

    return redirect()->route('dokter.profile.profile')->with('success', 'Profil berhasil diperbarui.');
}


    
    
    public function editProfile()
{
    $dokterId = session('dokter_id');

    if (!$dokterId) {
        return redirect()->route('dokter.login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
    }

    // Ambil data dokter beserta relasi poli
    $dokter = Dokter::with('poli')->find($dokterId);
    if (!$dokter) {
        return redirect()->route('dokter.dashboard')->withErrors(['error' => 'Data dokter tidak ditemukan.']);
    }

    // Ambil semua data poli untuk dropdown
    $polis = Poli::all();

    // Pastikan data poli ada dan dikirimkan ke view
    return view('dokter.profile.edit-profile', compact('dokter', 'polis'));
}

public function updateProfile(Request $request)
{
    // Ambil ID dokter dari session
    $dokterId = session('dokter_id');

    // Redirect ke login jika ID dokter tidak ada di session
    if (!$dokterId) {
        return redirect()->route('dokter.login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
    }

    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'no_hp' => 'nullable|string|max:255',
        'alamat' => 'nullable|string|min:6|confirmed', // Alamat dengan konfirmasi
        'id_poli' => 'required|exists:poli,id', // Validasi poli
    ]);

    // Ambil data dokter
    $dokter = Dokter::find($dokterId);
    if (!$dokter) {
        return redirect()->route('dokter.dashboard')->withErrors(['error' => 'Data dokter tidak ditemukan.']);
    }

    // Update data dokter
    $dokter->nama = $request->nama;
    $dokter->no_hp = $request->no_hp;
    $dokter->id_poli = $request->id_poli;

    // Update alamat jika diisi dan konfirmasi alamat cocok
    if ($request->alamat) {
        if ($request->alamat === $request->alamat_confirmation) {
            $dokter->alamat = $request->alamat;
        } else {
            return back()->withErrors(['alamat_confirmation' => 'Alamat dan konfirmasi alamat tidak cocok.']);
        }
    }

    // Simpan perubahan
    $dokter->save();

    // Redirect ke halaman profil dengan pesan sukses
    return redirect()->route('dokter.profile.profile')->with('success', 'Profil berhasil diperbarui.');
}

public function profile()
{
    $dokterId = session('dokter_id');
    if (!$dokterId) {
        return redirect()->route('dokter.login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
    }

    // Muat data dokter beserta relasi poli
    $dokter = Dokter::with('poli')->find($dokterId);
    if (!$dokter) {
        return redirect()->route('dokter.dashboard')->withErrors(['error' => 'Data dokter tidak ditemukan.']);
    }

    return view('dokter.profile.profile', compact('dokter'));
}



}
