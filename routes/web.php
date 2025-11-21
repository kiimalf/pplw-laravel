<?php

use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Dashboard;
use Illuminate\Support\Facades\Route;


route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cekKoneksi');



route::get('/home', [SiteController::class, 'home'])->name('home');

route::get('/about', [SiteController::class, 'about'])->name('about');

route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');

route::get('/struktur', [SiteController::class, 'struktur'])->name('struktur');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    route::get('/', [SiteController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('isAdmin')->prefix('admin')->name('admin.')->group(function()
    {
        Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');

        // USER
        Route::get('/user/index', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('user.create');
        Route::get('/user/edit/{iduser}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user.edit');
        
        Route::post('/user/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.store');
        Route::post('/user/update/{iduser}',[App\Http\Controllers\Admin\UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{iduser}/delete', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('user.delete');

        // ROLE
        Route::get('/role/index', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('role.index');
        Route::get('/role/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('role.create');
        Route::get('/role/edit/{iduser}',[App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('role.edit');

        Route::post('/role/store', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('role.store');
        Route::post('/role/update/{idrole}',[App\Http\Controllers\Admin\RoleController::class, 'update'])->name('role.update');
        Route::delete('/role/{idrole}/delete', [App\Http\Controllers\Admin\RoleController::class, 'delete'])->name('role.delete');

        // ROLE USER
        Route::get('/role-user/index', [App\Http\Controllers\Admin\RoleUserController::class, 'index'])->name('role-user.index');
        Route::get('/role-user-user/create', [App\Http\Controllers\Admin\RoleUserController::class, 'create'])->name('role-user.create');
        Route::get('/role-user/edit/{iduser}',[App\Http\Controllers\Admin\RoleUserController::class, 'edit'])->name('role-user.edit');

        Route::post('/role-user/store', [App\Http\Controllers\Admin\RoleUserController::class, 'store'])->name('role-user.store');
        Route::post('/role-user/update/{idrole}',[App\Http\Controllers\Admin\RoleUserController::class, 'update'])->name('role-user.update');
        Route::delete('/role-user/{idrole}/delete', [App\Http\Controllers\Admin\RoleUserController::class, 'delete'])->name('role-user.delete');

        // JENIS HEWAN
        Route::get('/jenis-hewan/index', [App\Http\Controllers\Admin\JenisHewanController::class, 'index'])->name('jenis-hewan.index');
        Route::get('/jenis-hewan/create', [App\Http\Controllers\Admin\JenisHewanController::class, 'create'])->name('jenis-hewan.create');
        Route::get('/jenis-hewan/edit/{idjenis_hewan}',[App\Http\Controllers\Admin\JenisHewanController::class, 'edit'])->name('jenis-hewan.edit');

        Route::post('/jenis-hewan/store', [App\Http\Controllers\Admin\JenisHewanController::class, 'store'])->name('jenis-hewan.store');
        Route::post('/jenis-hewan/update/{idjenis_hewan}',[App\Http\Controllers\Admin\JenisHewanController::class, 'update'])->name('jenis-hewan.update');
        Route::delete('/jenis-hewan/{idjenis_hewan}/delete', [App\Http\Controllers\Admin\JenisHewanController::class, 'delete'])->name('jenis-hewan.delete');

        // RAS HEWAN
        Route::get('/ras-hewan/index', [App\Http\Controllers\Admin\RasHewanController::class, 'index'])->name('ras-hewan.index');
        Route::get('/ras-hewan/create', [App\Http\Controllers\Admin\RasHewanController::class, 'create'])->name('ras-hewan.create');
        Route::get('/ras-hewan/edit/{idras_hewan}',[App\Http\Controllers\Admin\RasHewanController::class, 'edit'])->name('ras-hewan.edit');

        Route::post('/ras-hewan/store', [App\Http\Controllers\Admin\RasHewanController::class, 'store'])->name('ras-hewan.store');
        Route::post('/ras-hewan/update/{idras_hewan}',[App\Http\Controllers\Admin\RasHewanController::class, 'update'])->name('ras-hewan.update');
        Route::delete('/ras-hewan/{idras_hewan}/delete', [App\Http\Controllers\Admin\RasHewanController::class, 'delete'])->name('ras-hewan.delete');

        // PEMILIK
        Route::get('/pemilik/index', [App\Http\Controllers\Admin\PemilikController::class, 'index'])->name('pemilik.index');

        // PET
        Route::get('/pet/index', [App\Http\Controllers\Admin\PetController::class, 'index'])->name('pet.index');
        Route::get('/pet/create', [App\Http\Controllers\Admin\PetController::class, 'create'])->name('pet.create');
        Route::get('/pet/edit/{idpet}',[App\Http\Controllers\Admin\PetController::class, 'edit'])->name('pet.edit');

        Route::post('/pet/store', [App\Http\Controllers\Admin\PetController::class, 'store'])->name('pet.store');
        Route::post('/pet/update/{idpet}',[App\Http\Controllers\Admin\PetController::class, 'update'])->name('pet.update');
        Route::delete('/pet/{idpet}/delete', [App\Http\Controllers\Admin\PetController::class, 'delete'])->name('pet.delete');

        // TEMU DOKTER
        Route::get('/temu-dokter/index',[App\Http\Controllers\Admin\TemuDokterController::class, 'index'])->name('temu-dokter.index');
        Route::get('/temu-dokter/create', [App\Http\Controllers\Admin\TemuDokterController::class, 'create'])->name('temu-dokter.create');
        Route::get('/temu-dokter/edit/{idreservasi_dokter}',[App\Http\Controllers\Admin\TemuDokterController::class, 'edit'])->name('temu-dokter.edit');

        Route::post('/temu-dokter/store', [App\Http\Controllers\Admin\TemuDokterController::class, 'store'])->name('temu-dokter.store');
        Route::post('/temu-dokter/update/{idreservasi_dokter}',[App\Http\Controllers\Admin\TemuDokterController::class, 'update'])->name('temu-dokter.update');
        Route::delete('/temu-dokter/{idreservasi_dokter}/delete', [App\Http\Controllers\Admin\TemuDokterController::class, 'delete'])->name('temu-dokter.delete');

        // KATEGORI
        Route::get('/kategori/index', [App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/create', [App\Http\Controllers\Admin\KategoriController::class, 'create'])->name('kategori.create');
        Route::get('/kategori/edit/{idkategori}',[App\Http\Controllers\Admin\KategoriController::class, 'edit'])->name('kategori.edit');

        Route::post('/kategori/store', [App\Http\Controllers\Admin\KategoriController::class, 'store'])->name('kategori.store');
        Route::post('/kategori/update/{idkategori}',[App\Http\Controllers\Admin\KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{idkategori}/delete', [App\Http\Controllers\Admin\KategoriController::class, 'delete'])->name('kategori.delete');

        // KATEGORI KLINIS
        Route::get('/kategori-klinis/index', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'index'])->name('kategori-klinis.index');
        Route::get('/kategori-klinis/create', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'create'])->name('kategori-klinis.create');
        Route::get('/kategori-klinis/edit/{idkategori_klinis}',[App\Http\Controllers\Admin\KategoriKlinisController::class, 'edit'])->name('kategori-klinis.edit');

        Route::post('/kategori-klinis/store', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'store'])->name('kategori-klinis.store');
        Route::post('/kategori-klinis/update/{idkategori_klinis}',[App\Http\Controllers\Admin\KategoriKlinisController::class, 'update'])->name('kategori-klinis.update');
        Route::delete('/kategori-klinis/{idkategori_klinis}/delete', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'delete'])->name('kategori-klinis.delete');

        // KODE TINDAKAN TERAPI
        Route::get('/tindakan-terapi/index', [App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'index'])->name('tindakan-terapi.index');
        Route::get('/tindakan-terapi/create', [App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'create'])->name('tindakan-terapi.create');
        Route::get('/tindakan-terapi/edit/{idkode_tindakan_terapi}',[App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'edit'])->name('tindakan-terapi.edit');

        Route::post('/tindakan-terapi/store', [App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'store'])->name('tindakan-terapi.store');
        Route::post('/tindakan-terapi/update/{idkode_tindakan_terapi}',[App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'update'])->name('tindakan-terapi.update');
        Route::delete('/tindakan-terapi/{idkode_tindakan_terapi}/delete', [App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'delete'])->name('tindakan-terapi.delete');

        // REKAM MEDIS
        Route::get('/rekam-medis/index', [App\Http\Controllers\Admin\RekamMedisController::class, 'index'])->name('rekam-medis.index');

        // DETAIL REKAM MEDIS
        Route::get('/detail-rekam-medis/index', [App\Http\Controllers\Admin\DetailRekamMedisController::class, 'index'])->name('detail-rekam-medis.index');

    });
    Route::middleware('isResepsionis')->prefix('resepsionis')->name('resepsionis.')->group(function()
    {

    });
});

// require __DIR__.'/auth.php';

// Route::get('/', function () {
//     return view('welcome');
// });


// route::get('/admin/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user.index');

// route::get('/admin/role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.role.index');

// route::get('/admin/role-user', [App\Http\Controllers\Admin\RoleUserCOntroller::class, 'index'])->name('admin.roleUser.index');

// route::get('/admin/pemilik', [App\Http\Controllers\Admin\PemilikController::class, 'index'])->name('admin.pemilik.index');

// route::get('/admin/jenis-hewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'index'])->name('admin.jenisHewan.index');

// route::get('/admin/ras-hewan', [App\Http\Controllers\Admin\RasHewanController::class, 'index'])->name('admin.rasHewan.index');

// route::get('/admin/pet', [App\Http\Controllers\Admin\PetController::class, 'index'])->name('admin.pet.index');

// route::get('/admin/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('admin.kategori.index');

// route::get('/admin/kategori-klinis', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'index'])->name('admin.kategoriKlinis.index');

// route::get('/admin/kode-tindakan-terapi', [App\Http\Controllers\Admin\KodeTindakanTerapiController::class, 'index'])->name('admin.kodeTIndakanTerapi.index');

// route::get('/admin/rekam-medis', [App\Http\Controllers\Admin\RekamMedisController::class, 'index'])->name('admin.rekamMedis.index');

// route::get('/admin/detail-rekam-medis', [App\Http\Controllers\Admin\DetailRekamMedisController::class, 'index'])->name('admin.detailRekamMedis.index');