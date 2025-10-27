<?php

use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cekKoneksi');

route::get('/home', [SiteController::class, 'home'])->name('home');

route::get('/about', [SiteController::class, 'about'])->name('about');

route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');

route::get('/struktur', [SiteController::class, 'struktur'])->name('struktur');

route::get('/admin/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user.index');

route::get('/admin/role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.role.index');

route::get('/admin/role-user', [App\Http\Controllers\Admin\RoleUserCOntroller::class, 'index'])->name('admin.roleUser.index');

route::get('/admin/pemilik', [App\Http\Controllers\Admin\PemilikController::class, 'index'])->name('admin.pemilik.index');

route::get('/admin/jenis-hewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'index'])->name('admin.jenisHewan.index');

route::get('/admin/ras-hewan', [App\Http\Controllers\Admin\RasHewanController::class, 'index'])->name('admin.rasHewan.index');

route::get('/admin/pet', [App\Http\Controllers\Admin\PetController::class, 'index'])->name('admin.pet.index');

route::get('/admin/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('admin.kategori.index');

route::get('/admin/kategori-klinis', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'index'])->name('admin.kategoriKlinis.index');

route::get('/admin/kode-tindakan-terapi', [App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'index'])->name('admin.kodeTIndakanTerapi.index');

route::get('/admin/rekam-medis', [App\Http\Controllers\Admin\RekamMedisController::class, 'index'])->name('admin.rekamMedis.index');

route::get('/admin/detail-rekam-medis', [App\Http\Controllers\Admin\DetailRekamMedisController::class, 'index'])->name('admin.detailRekamMedis.index');