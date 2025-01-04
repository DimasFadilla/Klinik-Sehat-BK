<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Periksa;
use Illuminate\Http\Request;
use App\Models\DaftarPoli;

class DetailPeriksaController extends Controller
{

    
    // Menampilkan riwayat pemeriksaan pasien
    public function index($id_pasien)
    {
        // Ambil daftar pemeriksaan pasien berdasarkan id_pasien
        $daftar_periksa = Periksa::where('id_pasien', $id_pasien)
            ->orderBy('tgl_periksa', 'DESC')
            ->get();

        // Ambil data pasien berdasarkan ID yang diterima
        $pasien = Pasien::find($id_pasien); // Ambil pasien berdasarkan ID yang diterima

        if (!$pasien) {
            // Jika pasien tidak ditemukan, arahkan ke halaman lain dengan pesan error
            return redirect()->route('some.route')->with('error', 'Pasien tidak ditemukan');
        }

        // Kirimkan data pasien dan daftar pemeriksaan ke view
        return view('detailperiksa.index', compact('daftar_periksa', 'pasien'));
    }

    public function show(Pasien $pasien)
    {
        // Ambil data pemeriksaan pasien
        $periksa = $pasien->periksa()->orderBy('tgl_periksa', 'DESC')->get();
        return view('riwayat_pasien.show', compact('pasien', 'periksa'));
    }
    


    // public function index(Request $request)
    // {
    //     // Ambil data pasien berdasarkan ID (jika ada)
    //     $pasien = Pasien::find($request->get('id_pasien'));

    //     // Jika tidak ada ID pasien, tampilkan daftar pasien
    //     if (!$pasien) {
    //         return view('riwayat_pasien.index');
    //     }

    //     // Ambil data pemeriksaan pasien
    //     $periksa = $pasien->periksa()->orderBy('tanggal_periksa', 'DESC')->get();

    //     return view('riwayat_pasien.show', compact('pasien', 'periksa'));
    // }

    // public function show(Pasien $pasien)
    // {
    //     // Ambil data pemeriksaan pasien
    //     $periksa = $pasien->periksa()->orderBy('tanggal_periksa', 'DESC')->get(); return view('riwayat_pasien.show', compact('pasien', 'periksa'));
    // }
}