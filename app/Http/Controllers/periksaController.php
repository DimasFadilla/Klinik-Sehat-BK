<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use Illuminate\Http\Request;

class PeriksaController extends Controller
{
    // Menampilkan daftar pasien yang akan diperiksa
    public function index()
        {
            $daftarBelumDiperiksa = DaftarPoli::with('pasien')
                ->where('status', 'menunggu')
                ->get();

            $daftarSelesaiDiperiksa = DaftarPoli::with(['pasien', 'periksa'])
                ->where('status', 'selesai')
                ->get();

            return view('dokter.periksa.index', compact('daftarBelumDiperiksa', 'daftarSelesaiDiperiksa'));
        }

    // Menampilkan form pemeriksaan pasien
    public function edit($id)
    {
        $pasien = DaftarPoli::with('pasien')->findOrFail($id);
        $obatList = Obat::all(); // Ambil semua data obat
        return view('dokter.periksa.edit', compact('pasien', 'obatList'));
    }

    // Menyimpan catatan pemeriksaan pasien
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string|max:500',
            'obat' => 'required|array',
        ]);

        // Biaya Jasa Dokter
        $biayaJasaDokter = 150000;

        // Hitung total harga obat
        $totalBiayaObat = Obat::whereIn('id', $request->obat)->sum('harga');

        // Total Biaya Periksa
        $biayaPeriksa = $biayaJasaDokter + $totalBiayaObat;

        // Simpan data pemeriksaan
        $periksa = Periksa::create([
            'id_daftar_poli' => $id,
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $biayaPeriksa,
        ]);

        // Simpan detail obat yang diberikan
        foreach ($request->obat as $idObat) {
            DetailPeriksa::create([
                'id_periksa' => $periksa->id,
                'id_obat' => $idObat,
            ]);
        }

        // Update status pasien menjadi "selesai"
        $daftarPoli = DaftarPoli::findOrFail($id);
        $daftarPoli->status = 'selesai';
        $daftarPoli->save();

        return redirect()->route('dokter.periksa.index')->with('success', 'Pemeriksaan berhasil disimpan.');
    }

    public function detail($id)
{
    // Ambil data pemeriksaan dan relasi terkait
    $pasien = DaftarPoli::with(['pasien', 'periksa.detailPeriksa.obat'])->findOrFail($id);

    return view('dokter.periksa.detail', compact('pasien'));
}

}
