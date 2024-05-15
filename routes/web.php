<?php

use App\Http\Controllers\CalonController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\TargetController;
use App\Http\Controllers\Dashboard\HitungController;
use App\Http\Controllers\DptController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PemiluController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SelectorController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\TimsesController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//   return view('welcome');
// });

// Route::get('/dashboard', function () {
//   return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

  Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/target', [TargetController::class, 'index'])->name('dashboard.target');
    Route::get('/target/kecamatan/{kab}', [TargetController::class, 'kecamatan'])->name('dashboard.target.kec');
    Route::get('/target/kelurahan/{kec}', [TargetController::class, 'kelurahan'])->name('dashboard.target.kel');
    Route::get('/hitung', [HitungController::class, 'index'])->name('dashboard.hitung');
    Route::get('/hitung/kecamatan/{kab}', [HitungController::class, 'kecamatan'])->name('dashboard.hitung.kec');
    Route::get('/hitung/kelurahan/{kec}', [HitungController::class, 'kelurahan'])->name('dashboard.hitung.kel');
  });

  Route::get('/', function () {
    return redirect()->route('dashboard');
  });

  // Upload and delete temporary file
  Route::post('files/process', [FileUploadController::class, 'process']);
  Route::post('files/processberkas', [FileUploadController::class, 'processBerkas']);
  Route::delete('files/revert', [FileUploadController::class, 'revert']);

  Route::post('/getkec', [SelectorController::class, 'getKec']);
  Route::post('/getkel', [SelectorController::class, 'getKel']);
  Route::post('/gettps', [SelectorController::class, 'getTps']);
  Route::get('/selecttps', [SelectorController::class, 'selectTps']);
  Route::post('/ceknik', [SelectorController::class, 'ceknik']);

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

  Route::post('user/dt', [UserController::class, 'dt'])->name('user.dt');
  Route::post('user/multdelete', [UserController::class, 'multdelete'])->name('user.multdelete');
  Route::resource('user', UserController::class)->except('show');

  Route::post('menu/dt', [MenuController::class, 'dt'])->name('menu.dt');
  Route::resource('menu', MenuController::class)->except('show');

  Route::prefix('menu/submenu/{menu}')->group(function () {
    Route::get('/', [SubMenuController::class, 'index'])->name('submenu.index');
    Route::post('/dt', [SubMenuController::class, 'dt'])->name('submenu.dt');
    Route::get('/create', [SubMenuController::class, 'create'])->name('submenu.create');
    Route::post('/store', [SubMenuController::class, 'store'])->name('submenu.store');
    Route::get('/{submenu}/edit', [SubMenuController::class, 'edit'])->name('submenu.edit');
    Route::put('/update/{submenu}', [SubMenuController::class, 'update'])->name('submenu.update');
    Route::delete('/{submenu}', [SubMenuController::class, 'destroy'])->name('submenu.destroy');
  });

  Route::post('role/dt', [RoleController::class, 'dt'])->name('role.dt');
  Route::get('role/{role}/akses', [RoleController::class, 'akses'])->name('role.akses');
  Route::post('role/{role}/akses', [RoleController::class, 'aksesSync'])->name('akses.sync');
  Route::resource('role', RoleController::class)->except('show');

  Route::post('kabupaten/dt', [KabupatenController::class, 'dt'])->name('kabupaten.dt');
  Route::post('kabupaten/multdelete', [KabupatenController::class, 'multdelete'])->name('kabupaten.multdelete');
  Route::resource('kabupaten', KabupatenController::class)->except('show');

  Route::prefix('kecamatan/{kab?}')->group(function () {
    Route::get('/', [KecamatanController::class, 'index'])->name('kecamatan.index');
    Route::post('/dt', [KecamatanController::class, 'dt'])->name('kecamatan.dt');
    Route::get('/create', [KecamatanController::class, 'create'])->name('kecamatan.create');
    Route::post('/store', [KecamatanController::class, 'store'])->name('kecamatan.store');
    Route::get('/{kecamatan}/edit', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
    Route::put('/update/{kecamatan}', [KecamatanController::class, 'update'])->name('kecamatan.update');
    Route::delete('/{kecamatan}', [KecamatanController::class, 'destroy'])->name('kecamatan.destroy');
    Route::post('/multdelete', [KecamatanController::class, 'multdelete'])->name('kecamatan.multdelete');
  });

  Route::prefix('kelurahan/{kec?}')->group(function () {
    Route::get('/', [KelurahanController::class, 'index'])->name('kelurahan.index');
    Route::post('/dt', [KelurahanController::class, 'dt'])->name('kelurahan.dt');

    Route::get('/create', [KelurahanController::class, 'create'])->name('kelurahan.create');
    Route::post('/store', [KelurahanController::class, 'store'])->name('kelurahan.store');
    Route::get('/{kelurahan}/edit', [KelurahanController::class, 'edit'])->name('kelurahan.edit');
    Route::put('/update/{kelurahan}', [KelurahanController::class, 'update'])->name('kelurahan.update');
    Route::delete('/{kelurahan}', [KelurahanController::class, 'destroy'])->name('kelurahan.destroy');
    Route::post('/multdelete', [KelurahanController::class, 'multdelete'])->name('kelurahan.multdelete');
  });

  Route::post('tps/dt', [TpsController::class, 'dt'])->name('tps.dt');
  Route::post('tps/multdelete', [TpsController::class, 'multdelete'])->name('tps.multdelete');
  Route::resource('tps', TpsController::class)->except('show');

  Route::post('timses/dt', [TimsesController::class, 'dt'])->name('timses.dt');
  Route::post('timses/multdelete', [TimsesController::class, 'multdelete'])->name('timses.multdelete');
  Route::resource('timses', TimsesController::class)->except('show');

  Route::post('dpt/dt', [DptController::class, 'dt'])->name('dpt.dt');
  Route::post('dpt/multdelete', [DptController::class, 'multdelete'])->name('dpt.multdelete');
  Route::resource('dpt', DptController::class)->except('show');

  Route::post('calon/dt', [CalonController::class, 'dt'])->name('calon.dt');
  Route::post('calon/pilih/{calon}', [CalonController::class, 'pilih'])->name('calon.pilih');
  Route::post('calon/multdelete', [CalonController::class, 'multdelete'])->name('calon.multdelete');
  Route::resource('calon', CalonController::class)->except('show');

  Route::post('pemilu/dt', [PemiluController::class, 'dt'])->name('pemilu.dt');
  Route::post('pemilu/multdelete', [PemiluController::class, 'multdelete'])->name('pemilu.multdelete');
  Route::resource('pemilu', PemiluController::class)->except('show');

  Route::get('pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
  Route::post('pengaturan', [PengaturanController::class, 'store'])->name('pengaturan.store');
});

Route::get('tes/{id?}', function (Request $request, $id = 0) {
});


require __DIR__ . '/auth.php';
