<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    // Menampilkan data obat
    public function index()
    {
        $obats = Obat::all();
        return view('admin.obat.index', compact('obats'));
    }

    // Menampilkan form tambah obat
    public function create()
    {
        return view('admin.obat.create');
    }

    // Menyimpan data obat
    public function store(Request $request)
    {
        // Validasi untuk memastikan nama obat unik
        $request->validate([
            'nama_obat' => 'required|string|max:255|unique:obat,nama_obat',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        Obat::create($request->all());
        return redirect()->route('obat.index')->with('success', 'Data obat berhasil ditambahkan.');
    }

    // Menampilkan form edit obat
    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat.edit', compact('obat'));
    }

    // Mengupdate data obat
    public function update(Request $request, $id)
    {
        // Validasi untuk memastikan nama obat unik saat update
        $request->validate([
            'nama_obat' => 'required|string|max:255|unique:obat,nama_obat,' . $id,
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update([
            'nama_obat' => $request->input('nama_obat'),
            'kemasan' => $request->input('kemasan'),
            'harga' => $request->input('harga'),
        ]);

        return redirect()->route('obat.index')->with('success', 'Data obat berhasil diperbarui.');
    }

    // Menghapus data obat
    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('obat.index')->with('success', 'Data obat berhasil dihapus.');
    }
}
