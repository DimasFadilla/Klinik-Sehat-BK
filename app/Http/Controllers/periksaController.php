<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;

class PeriksaController extends Controller
{
    // Menampilkan daftar pasien yang akan diperiksa
    public function index()
    {
        $daftarPasien = DaftarPoli::with('pasien')->where('status', 'menunggu')->get();
        return view('dokter.periksa.index', compact('daftarPasien'));
    }

    // Menampilkan form pemeriksaan pasien
    public function edit($id)
    {
        $pasien = DaftarPoli::with('pasien')->findOrFail($id);
        return view('dokter.periksa.edit', compact('pasien'));
    }

    // Menyimpan catatan pemeriksaan pasien
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string|max:500',
            'biaya_periksa' => 'required|numeric',
            'obat' => 'required|array',
        ]);

        // Menyimpan data pemeriksaan
        $periksa = Periksa::create([
            'id_daftar_poli' => $id,
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->biaya_periksa,
        ]);

        // Menyimpan detail obat yang diberikan
        foreach ($request->obat as $namaObat) {
            DetailPeriksa::create([
                'id_periksa' => $periksa->id,
                'nama_obat' => $namaObat,
            ]);
        }

        // Update status pasien menjadi "selesai"
        $daftarPoli = DaftarPoli::findOrFail($id);
        $daftarPoli->status = 'selesai';
        $daftarPoli->save();

        return redirect()->route('periksa.index')->with('success', 'Pemeriksaan berhasil disimpan.');
    }
}
