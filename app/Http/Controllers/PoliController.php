<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poli;

 
class PoliController extends Controller
{
    // Menampilkan Data Poli
    public function index()
    {
        $polis = Poli::all(); // Ambil semua data poli
        return view('admin.poli.index', compact('polis'));
    }

    // Menampilkan Form untuk Menambah Poli
    public function create()
    {
        return view('admin.poli.create');
    }

    // Menyimpan Data Poli
    public function store(Request $request)
{
    $validated = $request->validate([
        'nama_poli' => 'required|string|max:255|unique:poli,nama_poli',
        'keterangan' => 'nullable|string|max:255',
    ], [
        'nama_poli.unique' => 'Nama poli sudah digunakan. Silakan masukkan nama yang berbeda.',
    ]);

    Poli::create($validated); // Menyimpan data poli ke database

    return redirect()->route('poli.index')->with('success', 'Poli berhasil ditambahkan.');
}

    // Menampilkan Form untuk Mengupdate Poli
    public function edit($id)
    {
        $poli = Poli::find($id);
        
        if (!$poli) {
            return redirect()->route('poli.index')->with('error', 'Poli tidak ditemukan.');
        }

        return view('admin.poli.edit', compact('poli'));
    }

    // Mengupdate Data Poli
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nama_poli' => 'required|string|max:255|unique:poli,nama_poli,' . $id,
        'keterangan' => 'nullable|string|max:255',
    ], [
        'nama_poli.unique' => 'Nama poli sudah digunakan. Silakan masukkan nama yang berbeda.',
    ]);

    $poli = Poli::find($id);

    if (!$poli) {
        return redirect()->route('poli.index')->with('error', 'Poli tidak ditemukan.');
    }

    $poli->update($validated); // Mengupdate data poli

    return redirect()->route('poli.index')->with('success', 'Poli berhasil diperbarui.');
}


    // Menghapus Data Poli
    public function destroy($id)
    {
        $poli = Poli::find($id);

         // Mengecek jika poli tidak ditemukan
        if (!$poli) {
            return redirect()->route('poli.index')->with('error', 'Poli tidak ditemukan.');
        }

        $poli->delete(); // Menghapus data poli

        return redirect()->route('poli.index')->with('success', 'Poli berhasil dihapus.');
    }
}
