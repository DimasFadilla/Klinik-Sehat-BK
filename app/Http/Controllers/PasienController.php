<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ini benar
use Illuminate\Support\Facades\Log;


class PasienController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);
    
        // Cari pasien berdasarkan nama dan alamat
        $pasien = Pasien::where('nama', $request->name)
                        ->where('alamat', $request->alamat)
                        ->first();
    
        // Debugging untuk melihat hasil query
        if (!$pasien) {
            return back()->withErrors(['error' => 'Nama atau alamat tidak ditemukan.']);
        }
    
        // Simpan data ke session
        session(['pasien_id' => $pasien->id, 'pasien_nama' => $pasien->nama]);
    
        // Redirect ke dashboard pasien
        return redirect()->route('pasien.dashboard');
    }


    // public function login(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'name' => 'required',
    //         'alamat' => 'required',
    //     ]);
    
    //     // Cari pasien berdasarkan nama dan alamat
    //     $pasien = Pasien::where('nama', $request->name)
    //                     ->where('alamat', $request->alamat)
    //                     ->first();
    
    //     // Periksa apakah data pasien valid
    //     if ($pasien) {
    //         // Simpan data ke session
    //         session(['dokter_id' => $pasien->id, 'dokter_nama' => $pasien->nama]);
    
    //         // Autentikasi pasien
    //         Auth::guard('pasien')->login($pasien);
    
    //         // Redirect ke dashboard pasien
    //         return redirect()->route('pasien.dashboard');
    //     }
    
        // Jika gagal login, kembali ke halaman login dengan pesan error
       // return back()->withErrors(['nama' => 'Nama atau alamat salah.']);
   // }


    // Tampilkan daftar pasien
    public function index()
    {
        $pasiens = Pasien::all();
        return view('admin.pasien.index', compact('pasiens'));
    }

    
    // Menampilkan form login pasien
    public function showLoginForm()
    {
        return view('pasien.auth.pasien-login');  // Pastikan Anda memiliki view untuk form login pasien
    }

    // Menampilkan form registrasi pasien
    public function showRegistrationForm()
    {
        return view('pasien.auth.pasien-register'); // Pastikan Anda memiliki view untuk form registrasi pasien
    }

    public function show($id)
    {
        $pasien = Pasien::findOrFail($id);  // Find pasien by ID
        return view('admin.pasien.show', compact('pasien'));  // Return the view with pasien data
    }

     // Proses registrasi pasien
     public function register(Request $request)
     {
         // Log input untuk debugging
         Log::info('Data registrasi pasien diterima: ', $request->all());
 
         // Validasi input
         $request->validate([
             'nama' => 'required|string|max:255',
             'alamat' => 'required|string|max:255',
             'no_ktp' => 'required|numeric|unique:pasien',
            'no_hp' => 'required|numeric|unique:pasien,no_hp,',
            // 'no_hp' => 'required|regex:/^(08|62)[0-9]{8,12}$/|unique:pasien', 
            'no_rm' => 'required|unique:pasien', 
         ]);
 
         try {
             // Simpan data ke database
             Pasien::create($request->all());
 
             // Log keberhasilan
             Log::info('Data pasien berhasil disimpan.');
 
             // Redirect dengan pesan sukses
             return redirect()->route('pasien.login')->with('success', 'Registrasi berhasil. Silakan login.');
         } catch (\Exception $e) {
             // Log error
             Log::error('Error saat registrasi pasien: ' . $e->getMessage());
 
             // Redirect dengan pesan error
             return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
         }
     }



    // Tampilkan form tambah pasien
    public function create()
    {
        return view('admin.pasien.create');
    }

    // Simpan data pasien baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_ktp' => 'required|numeric|unique:pasien',
            'no_hp' => 'required|numeric|unique:pasien,no_hp,',
            // 'no_hp' => 'required|regex:/^(08|62)[0-9]{8,12}$/|unique:pasien', 
            'no_rm' => 'required|unique:pasien',
        ]);
    
        Pasien::create($request->all());
    
        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }
    
    

    // Tampilkan form edit pasien
    public function edit(Pasien $pasien)
    {
        return view('admin.pasien.edit', compact('pasien'));
    }

    // Update data pasien pada admin
    public function update(Request $request, Pasien $pasien)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_ktp' => 'required|numeric|unique:pasien,no_ktp,' . $pasien->id, 
            'no_hp' => 'required|numeric|unique:pasien,no_hp,' . $pasien->id, 
            // 'no_hp' => 'required|regex:/^(08|62)[0-9]{8,12}$/|unique:pasien,no_hp,' . $pasien->id,
            'no_rm' => 'required|unique:pasien,no_rm,' . $pasien->id, 
        ]);
    
        // Log data setelah validasi berhasil
        Log::info('Validasi berhasil, data yang akan diupdate:', $request->all());
    
        try {
            // Pilih field yang akan diupdate, hanya yang relevan saja
            $updatedData = $request->only(['nama', 'alamat', 'no_ktp', 'no_hp', 'no_rm']);
    
            // Proses update data pasien
            $isUpdated = $pasien->update($updatedData);
    
            // Debugging untuk melihat apakah update berhasil
            if ($isUpdated) {
                Log::info('Data pasien berhasil diupdate:', $updatedData);
                return redirect()->route('admin.pasien.index', $pasien->id)->with('success', 'Data pasien berhasil diupdate.');
            } else {
                return back()->withErrors(['error' => 'Gagal memperbarui data pasien.']);
            }
        } catch (\Exception $e) {
            // Tangani error jika terjadi masalah saat update
            Log::error('Error saat mengupdate data pasien: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data pasien.']);
        }
    }
    

    

    // Hapus data pasien
    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil dihapus.');
    }

    public function dashboard()
    {
        $pasienId = session('pasien_id'); // Menggunakan pasien_id dari session
        $pasien = Pasien::findOrFail($pasienId);
        
        $pasien = Pasien::with(['daftarPoli.periksa.detailPeriksa.obat'])->findOrFail($pasienId);

        $pemeriksaan = $pasien->daftarPoli->flatMap->periksa; // Mendapatkan semua pemeriksaan
       

        return view('pasien.dashboard', compact('pasien', 'pemeriksaan'));
    }


// public function dashboard()
// {
//     $pasien = Auth::guard('pasien')->user();
//     $pemeriksaan = $pasien->pemeriksaan; // Assuming 'pemeriksaan' is a hasMany relationship

//     return view('pasien.dashboard', compact('pasien', 'pemeriksaan'));
// }


public function logout(Request $request)
{
    $request->session()->forget(['pasien_id', 'pasien_nama']);
    return redirect()->route('pasien.login');
}
//     public function logout(Request $request)
// {
//     Auth::guard('pasien')->logout();
//     return redirect()->route('pasien.login');
// }

}
