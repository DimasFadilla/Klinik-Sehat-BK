<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\DaftarPoliController;
use App\Http\Controllers\JadwalPeriksaController;
use App\Http\Controllers\DetailPeriksaController;
use Illuminate\Support\Facades\DB;
use \App\Http\Middleware\PasienAuth;
use \App\Http\Middleware\CheckAdmin;
use \App\Http\Middleware\DokterAuth;
use \App\Http\Kernel;


// Welcome and Database Check Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/check-db', function () {
    return DB::connection()->getDatabaseName();
});

// Admin Routes
Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminController::class, 'login']);
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
Route::get('/pasien/{pasien}/edit', [PasienController::class, 'edit'])->name('admin.pasien.edit');
Route::put('/pasien/{id}', [PasienController::class, 'update'])->name('pasien.update');
Route::delete('/pasien/{pasien}', [PasienController::class, 'destroy'])->name('pasien.destroy');
Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');

Route::prefix('admin')->name('admin.')->group(function () {
   
});

Route::get('/jadwal-dokter', function () {
    $jadwal = [
        ['dokter' => 'dr. Andi Wijaya', 'spesialis' => 'Kandungan', 'hari' => 'Senin', 'jam' => '08:00 - 14:00'],
        ['dokter' => 'dr. Siti Rahmah', 'spesialis' => 'Anak', 'hari' => 'Selasa', 'jam' => '10:00 - 16:00'],
    ];
    return view('jadwal.dokter', compact('jadwal'));
})->name('jadwal.dokter');


Route::get('/jadwal', function () {
    return view('jadwal.index');
});



// Dokter Routes
Route::get('dokter/dashboard', [DokterController::class, 'dashboard'])->name('dokter.dashboard');
Route::get('dokter/login', [DokterController::class, 'showLoginForm'])->name('dokter.login');
Route::post('dokter/login', [DokterController::class, 'login'])->name('dokter.login.post');
Route::get('dokter/create', [DokterController::class, 'create'])->name('dokter.create');
Route::post('dokter', [DokterController::class, 'store'])->name('dokter.store');
Route::get('dokter/{dokter}/edit', [DokterController::class, 'edit'])->name('dokter.edit');
Route::put('dokter/{dokter}', [DokterController::class, 'update'])->name('dokter.update');
Route::delete('dokter/{dokter}', [DokterController::class, 'destroy'])->name('dokter.destroy');
Route::get('dokter/{dokter}', [DokterController::class, 'show'])->name('dokter.show');
Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
Route::post('/dokter/logout', [DokterController::class, 'logout'])->name('dokter.logout');

//dokter profile
Route::get('/dokter/profile/profile', [DokterController::class, 'profile'])->name('dokter.profile.profile');
Route::get('/dokter/profile/edit-profile', [DokterController::class, 'editProfile'])->name('dokter.profile.edit-profile');



//dokter jadwal

 Route::get('/jadwal', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwal.index');
 Route::get('/jadwal/create', [JadwalPeriksaController::class, 'create'])->name('dokter.jadwal.create');
Route::post('/dokter/jadwal', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal.store');
Route::get('/dokter/jadwal/{jadwal}/edit', [JadwalPeriksaController::class, 'edit'])->name('dokter.jadwal.edit');
Route::put('/jadwal/{jadwal}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwal.update');
Route::delete('/dokter/jadwal/{jadwal}', [JadwalPeriksaController::class, 'destroy'])->name('dokter.jadwal.destroy');

// dokter periksa
Route::get('/periksa', [PeriksaController::class, 'index'])->name('dokter.periksa.index');
Route::get('/dokter/periksa/{id}/edit', [PeriksaController::class, 'edit'])->name('dokter.periksa.edit');
Route::put('/dokter/periksa/{id}', [PeriksaController::class, 'update'])->name('periksa.update');
Route::post('/dokter/logout', [DokterController::class, 'logout'])->name('dokter.logout');
//detail periksa
Route::get('/detailperiksa/{id}', [DetailPeriksaController::class, 'index'])->name('detailperiksa.index');
Route::get('/detailperiksa/show/{pasien}', [DetailPeriksaController::class, 'show'])->name('detailperiksa.show');



// Pasien Routes
Route::get('pasien/dashboard', [PasienController::class, 'dashboard'])->name('pasien.dashboard');
Route::get('pasien/register', [PasienController::class, 'showRegistrationForm'])->name('pasien.register');
Route::post('pasien/register', [PasienController::class, 'register'])->name('pasien.register.submit');
Route::get('pasien/login', [PasienController::class, 'showLoginForm'])->name('pasien.login');
Route::post('pasien/login', [PasienController::class, 'login'])->name('pasien.login.post');
Route::post('pasien/logout', [PasienController::class, 'logout'])->name('pasien.logout');
Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
Route::get('pasien/{id}', [PasienController::class, 'show'])->name('pasien.detail');
Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
 Route::get('/pasien/{pasien}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
 Route::delete('/pasien/{pasien}', [PasienController::class, 'destroy'])->name('pasien.destroy');
 Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
Route::get('pasien/{id}', [PasienController::class, 'show'])->name('pasien.show');

//daftarpoli
Route::get('/daftar', [DaftarPoliController::class, 'index'])->name('daftar.index');
Route::post('/daftar', [DaftarPoliController::class, 'store'])->name('daftar.store');
Route::get('/daftar/create', [DaftarPoliController::class, 'create'])->name('daftar.create');
Route::get('/dokter/{id_poli}', [DaftarPoliController::class, 'getDokterByPoli']);
Route::get('/jadwal/{id_dokter}', [DaftarPoliController::class, 'getJadwalByDokter']);
// Route::get('pasien/daftarpoli/create', [DaftarPoliController::class, 'create'])->name('pasien.daftarpoli.create');
// Route::post('pasien/daftarpoli', [DaftarPoliController::class, 'store'])->name('pasien.daftarpoli.store');
// Route::get('/pasien/daftarpoli', [DaftarPoliController::class, 'index'])->name('pasien.daftapolir.index');
// Route::get('pasien/daftarpoli/dokter/{id_poli}', [DaftarPoliController::class, 'getDokterByPoli'])->name('pasien.daftarpoli.dokter');
// Route::get('pasien/daftarpoli/jadwal/{id_dokter}', [DaftarPoliController::class, 'getJadwalByDokter'])->name('pasien.daftarpoli.jadwal');


// Obat Routes
Route::resource('obat', ObatController::class);

// Poli Routes
Route::resource('poli', PoliController::class);

// Admin Middleware Group
Route::middleware(['admin'])->group(function () {
    // Additional admin routes can be added here
});

// Dokter Middleware Group
Route::middleware(['dokter.auth'])->group(function () {
        //Route::get('dokter/dashboard', [DokterController::class, 'dashboard'])->name('dokter.dashboard');
        //Route::get('/jadwal', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwal.index');
        // Route::get('/jadwal/create', [JadwalPeriksaController::class, 'create'])->name('dokter.jadwal.create');
        // Route::post('/dokter/jadwal', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal.store');
        // Route::get('/dokter/jadwal/{jadwal}/edit', [JadwalPeriksaController::class, 'edit'])->name('dokter.jadwal.edit');
        // Route::put('/dokter/jadwal/{jadwal}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwal.update');
        // Route::delete('/dokter/jadwal/{jadwal}', [JadwalPeriksaController::class, 'destroy'])->name('dokter.jadwal.destroy');
   
        //dokter periksa
        // Route::get('/periksa', [PeriksaController::class, 'index'])->name('dokter.periksa.index');
        // Route::get('/dokter/periksa/{id}/edit', [PeriksaController::class, 'edit'])->name('dokter.periksa.edit');
        // Route::put('/dokter/periksa/{id}', [PeriksaController::class, 'update'])->name('periksa.update');
        // //dokter profile
        // Route::get('/profile', [DokterController::class, 'profile'])->name('dokter.profile');
        // Route::get('/dokter/edit-profile', [DokterController::class, 'editProfile'])->name('dokter.edit-profile');
        // Route::post('/dokter/update-profile', [DokterController::class, 'updateProfile'])->name('dokter.update-profile');
        // // riwayat pasien
        // Route::get('/detail_periksa', [DetailPeriksaController::class, 'index'])->name('detail_periksa.index');
        //Route::get('/dokter/riwayat-pasien', [DetailPeriksaController::class, 'index'])->name('dokter.riwayat.index');
        //Route::get('/detailperiksa/{id_pasien}', [RiwayatController::class, 'index'])->name('detailperiksa.index');


    // Additional dokter routes can be added here
    //Route::get('/dashboard', [DokterController::class, 'dashboard'])->name('dashboard');
    //  Route::get('/profile', [DokterController::class, 'profile'])->name('profile');
     //Route::get('/dokter/edit-profile', [DokterController::class, 'editProfile'])->name('dokter.edit-profile');
    // Route::get('/dokter/edit-profile', function () {
    //     dd('Rute berhasil diakses.');
    // });
    //Route::post('/dokter/logout', [DokterController::class, 'logout'])->name('logout');
    // Route::get('/periksa', [PeriksaController::class, 'index'])->name('periksa.index');
    // Route::get('/periksa/{id}/edit', [PeriksaController::class, 'edit'])->name('periksa.edit');
    // Route::put('/periksa/{id}', [PeriksaController::class, 'update'])->name('periksa.update');
    // Route::post('/update-profile', [DokterController::class, 'updateProfile'])->name('dokter.update-profile');
   // Rute untuk mengelola jadwal periksa
//     Route::get('/jadwal', [JadwalPeriksaController::class, 'index'])->name('jadwal.index');
//     Route::get('/jadwal/create', [JadwalPeriksaController::class, 'create'])->name('dokter.jadwal.create');
//     Route::post('/dokter/jadwal', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal.store');
//     Route::get('/dokter/jadwal/{jadwal}/edit', [JadwalPeriksaController::class, 'edit'])->name('dokter.jadwal.edit');
//     Route::put('/dokter/jadwal/{jadwal}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwal.update');
//     Route::delete('/dokter/jadwal/{jadwal}', [JadwalPeriksaController::class, 'destroy'])->name('dokter.jadwal.destroy');
});

