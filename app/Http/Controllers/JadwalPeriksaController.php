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
        // Validasi input, tetapi buat opsional agar field yang kosong tidak memengaruhi data
        $request->validate([
            'hari' => 'nullable|string|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'jam_mulai' => 'nullable|date_format:H:i',
            'jam_selesai' => 'nullable|date_format:H:i|after:jam_mulai',
        ]);
    
        try {
            // Periksa apakah input ada sebelum memperbarui
            if ($request->has('hari')) {
                $jadwal->hari = $request->input('hari');
            }
    
            if ($request->has('jam_mulai')) {
                $jadwal->jam_mulai = $request->input('jam_mulai');
            }
    
            if ($request->has('jam_selesai')) {
                $jadwal->jam_selesai = $request->input('jam_selesai');
            }
    
            // Simpan perubahan ke database
            $jadwal->save();
    
            // Redirect ke halaman yang sesuai dengan pesan sukses
            return redirect()->route('dokter.jadwal.index')->with('success', 'Jadwal berhasil diupdate');
        } catch (\Exception $e) {
            // Tangkap error dan redirect dengan pesan error
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
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