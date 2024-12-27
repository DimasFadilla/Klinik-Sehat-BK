<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
            //MENAMPILKAN DAYA OBAT
            public function index()
        {
            $obats = Obat::all();
            return view('admin.obat.index', compact('obats'));
        }
        //MENAMBAH DATA OBAT
        public function create()
{
    return view('admin.obat.create');
}
    //STORE DATA
    public function store(Request $request)
{
    $request->validate([
        'nama_obat' => 'required|string|max:255',
        'kemasan' => 'required|string|max:255',
        'harga' => 'required|numeric|min:0',
    ]);

    Obat::create($request->all());
    return redirect()->route('obat.index')->with('success', 'Data obat berhasil ditambahkan.');
}

    //UPDATE DATA
    // Metode edit untuk menampilkan form edit obat
    public function edit($id)
    {
        // Cari obat berdasarkan ID
        $obat = Obat::findOrFail($id);

        // Tampilkan view edit dengan data obat
        return view('admin.obat.edit', compact('obat'));
    }

    // Metode update untuk menyimpan perubahan data obat
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        // Cari obat berdasarkan ID
        $obat = Obat::findOrFail($id);

        // Update data obat
        $obat->update([
            'nama_obat' => $request->input('nama_obat'),
            'kemasan' => $request->input('kemasan'),
            'harga' => $request->input('harga'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('obat.index')->with('success', 'Data obat berhasil diperbarui.');
    }
    //DESTROY DATA
    public function destroy(Obat $obat)
{
    $obat->delete();
    return redirect()->route('obat.index')->with('success', 'Data obat berhasil dihapus.');
}

}
