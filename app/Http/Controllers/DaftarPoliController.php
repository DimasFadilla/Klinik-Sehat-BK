<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Poli;

class DaftarPoliController extends Controller
{
    // Menampilkan daftar pendaftaran poli untuk pasien yang sedang login
    public function index()
    {
        $pasienId = session('pasien_id'); // Bisa menggunakan Auth::id() jika menggunakan autentikasi
    
        // Ambil data pendaftaran poli yang terkait dengan pasien
        $pemeriksaan = DaftarPoli::with('jadwalPeriksa.dokter.poli')
            ->where('id_pasien', $pasienId)
            ->get();
    
        return view('daftar.index', compact('pemeriksaan'));
    }
    

    // Fungsi untuk menampilkan form pendaftaran poli
    public function create()
    {
        // Ambil semua data poli untuk ditampilkan di dropdown
        $polis = Poli::all();
        
        return view('daftar.create', compact('polis'));
    }

    // Menyimpan pendaftaran poli
    public function store(Request $request)
    {
        $request->validate([
            'id_poli' => 'required|exists:polis,id',
            'id_dokter' => 'required|exists:dokters,id',
            'id_jadwal' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required|string|max:255',
        ]);
    
        // Ambil ID pasien dari session atau auth
        $pasienId = session('pasien_id'); // Bisa menggunakan Auth::id() jika menggunakan autentikasi
    
        // Hitung nomor antrian berdasarkan jadwal
        $lastAntrian = DaftarPoli::where('id_jadwal', $request->id_jadwal)->max('no_antrian');
        $nextAntrian = $lastAntrian ? $lastAntrian + 1 : 1;
    
        // Simpan data pendaftaran poli
        DaftarPoli::create([
            'id_pasien' => $pasienId,
            'id_poli' => $request->id_poli,
            'id_dokter' => $request->id_dokter,
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $nextAntrian,
        ]);
    
        return redirect()->route('daftar.index')->with('success', 'Pendaftaran poli berhasil.');
    }
    
    public function getDokterByPoli($id_poli)
{
    $dokters = Dokter::where('id_poli', $id_poli)->get();
    if ($dokters->isEmpty()) {
        return response()->json(['message' => 'Tidak ada dokter di poli ini.'], 404);
    }
    return response()->json($dokters);
}

public function getJadwalByDokter($id_dokter)
{
    $jadwals = JadwalPeriksa::where('id_dokter', $id_dokter)->get();
    if ($jadwals->isEmpty()) {
        return response()->json(['message' => 'Tidak ada jadwal untuk dokter ini.'], 404);
    }
    return response()->json($jadwals);
}


 
}







//program lama

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\DaftarPoli;
// use App\Models\Poli;
// use App\Models\Dokter;
// use App\Models\JadwalPeriksa;
// use App\Models\Pasien;

// class DaftarPoliController extends Controller
// {
//     /**
//      * Pastikan pasien sudah login sebelum mendaftar poli
//      */
//     public function __construct()
//     {
//         $this->middleware('auth');  // Memastikan pasien sudah login
//     }

    // Menampilkan Form Pendaftaran Poli untuk Pasien yang Login
//     public function create()
//     {
//         // Ambil semua poli yang ada untuk ditampilkan
//         $polis = Poli::all();
//         return view('pasien.daftarpoli.create', compact('polis'));
//     }

//     // Menampilkan Dokter Berdasarkan Poli yang Dipilih oleh Pasien
//     public function getDokterByPoli($id_poli)
//     {
//         // Ambil dokter yang terdaftar pada poli yang dipilih
//         $dokters = Dokter::where('id_poli', $id_poli)->get();
        
//         if ($dokters->isEmpty()) {
//             return response()->json(['error' => 'Tidak ada dokter pada poli ini.'], 404);
//         }

//         return response()->json($dokters);
//     }

//     // Menampilkan Jadwal Dokter Berdasarkan Dokter yang Dipilih
//     public function getJadwalByDokter($id_dokter)
//     {
//         // Ambil jadwal periksa dokter yang dipilih
//         $jadwals = JadwalPeriksa::where('id_dokter', $id_dokter)->get();

//         if ($jadwals->isEmpty()) {
//             return response()->json(['error' => 'Tidak ada jadwal untuk dokter ini.'], 404);
//         }

//         return response()->json($jadwals);
//     }

//     // Menyimpan Data Pendaftaran Poli oleh Pasien
//     public function store(Request $request)
//     {
//         // Validasi input dari pasien
//         $validated = $request->validate([
//             'keluhan' => 'required|string|max:255',
//             'id_poli' => 'required|exists:poli,id',  // Pastikan poli yang dipilih ada
//             'id_dokter' => 'required|exists:dokter,id', // Pastikan dokter yang dipilih ada
//             'id_jadwal' => 'required|exists:jadwal_periksa,id', // Pastikan jadwal yang dipilih ada
//         ]);

//         // Mendapatkan data dokter dan poli
//         $dokter = Dokter::find($request->id_dokter);
//         $poli = $dokter->poli;

//         // Menghitung nomor antrian berdasarkan poli dan jadwal
//         $no_antrian = DaftarPoli::where('id_jadwal', $request->id_jadwal)
//             ->orderBy('no_antrian', 'desc')
//             ->first()->no_antrian + 1;

//         // Menyimpan data pendaftaran poli
//         DaftarPoli::create([
//             'id_pasien' => auth()->user()->id,  // Menggunakan ID pasien yang sedang login
//             'id_poli' => $request->id_poli,
//             'id_dokter' => $request->id_dokter,
//             'id_jadwal' => $request->id_jadwal,
//             'keluhan' => $request->keluhan,
//             'no_antrian' => $no_antrian,
//         ]);

//         return redirect()->route('daftar.index')->with('success', 'Pendaftaran poli berhasil.');
//     }

//     // Menampilkan Daftar Pendaftaran Poli Pasien yang Login
//     public function index()
//     {
//         // Mengambil daftar pendaftaran poli untuk pasien yang sedang login
//         $daftarPolis = DaftarPoli::with('pasien', 'jadwalPeriksa.dokter', 'jadwalPeriksa.dokter.poli')
//             ->where('id_pasien', session('pasien_id'))  // Menggunakan session untuk mendapatkan ID pasien
//             ->get();
    
//         return view('daftar.index', compact('daftarPolis'));
//     }
    
// }
