<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;
use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;


class JadwalPeriksaController extends Controller
{
    // Menampilkan form untuk menambah jadwal periksa
    public function create()
    {
        return view('dokter.jadwal.create'); // Pastikan view ini ada
    }

    // Menyimpan jadwal periksa baru
    public function store(Request $request)
{
    $request->validate([
        'hari' => 'required|string',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
    ]);

    $id_dokter = session('dokter_id'); // Ambil ID dokter dari session

    if (!$id_dokter) {
        return redirect()->route('dokter.login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
    }

    $jadwal = new JadwalPeriksa();
    $jadwal->id_dokter = $id_dokter; // Set ID dokter
    $jadwal->hari = $request->hari;
    $jadwal->jam_mulai = $request->jam_mulai;
    $jadwal->jam_selesai = $request->jam_selesai;
    $jadwal->save();

    return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
}

    //     public function store(Request $request)
// {
//     $request->validate([
//         'hari' => 'required|string',
//         'jam_mulai' => 'required|date_format:H:i',
//         'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
//     ]);

//     $id_dokter = session('dokter_id'); // Ambil ID dokter dari session
    

//     if (!$id_dokter) {
//         return redirect()->route('dokter.login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
//     }

//     $jadwal = new JadwalPeriksa();
//     $jadwal->id_dokter = $id_dokter; // Set ID dokter
//     $jadwal->hari = $request->hari;
//     $jadwal->jam_mulai = $request->jam_mulai;
//     $jadwal->jam_selesai = $request->jam_selesai;
//     $jadwal->save();

//     return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
// }
    // Menampilkan semua jadwal periksa
    public function index()
    {
        $id_dokter = session('dokter_id'); // Ambil ID dokter dari session
        $jadwals = JadwalPeriksa::where('id_dokter', $id_dokter)->get();
        // $pasien = Pasien::find(1); 
        return view('dokter.jadwal.index', compact('jadwals'));
    }

    // Menampilkan form untuk mengedit jadwal periksa
    public function edit(JadwalPeriksa $jadwal)
    {
        return view('dokter.jadwal.edit', compact('jadwal'));
    }

    // Mengupdate jadwal periksa
    public function update(Request $request, JadwalPeriksa $jadwal)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'hari' => 'required|string|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu', // jika hanya satu hari yang diterima
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);
        
    
        // Update data jadwal dengan input form
        $jadwal->hari = $request->input('hari');
        $jadwal->jam_mulai = $request->input('jam_mulai');
        $jadwal->jam_selesai = $request->input('jam_selesai');
    
        // Simpan perubahan
        $jadwal->save();
    
        // Redirect ke halaman yang sesuai setelah update
        return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal berhasil diupdate');
    }
    

    // Menghapus jadwal periksa
public function destroy($id)
{
    // Cari jadwal berdasarkan ID
    $jadwal = JadwalPeriksa::findOrFail($id);

    // Hapus jadwal
    $jadwal->delete();

    // Redirect kembali ke halaman jadwal dengan pesan sukses
    return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
}


}