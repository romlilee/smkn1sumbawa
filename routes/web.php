<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrasiController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\MateriCOntroller;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BeljarController;
use App\Http\Controllers\BlogController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('/', [AuthController::class, 'login']);
Route::get('/about', 'front\WelcomeController@about')->name('about');
Route::get('/belajar', [BeljarController::class, 'index'])->name('kelasb');
Route::get('/belajar/detail/{id}', [BeljarController::class, 'detail'])->name('kelasb.detail');
Route::get('/belajar/pelajar/{id}/{idvideo}', [BeljarController::class, 'belajar'])->name('kelasb.belajar');

Route::group(['middleware' => ['auth', 'ceklevel:admin,kepsek,guru,siswa']], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('siswa', SiswaController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('matapelajaran', MatapelajaranController::class);
    Route::resource('soal', SoalController::class);

    Route::get('materi', [MateriCOntroller::class, 'index'])->name('admin.kelas');
    Route::get('materi/tambah', [MateriCOntroller::class, 'tambah'])->name('admin.kelas.tambah');
    Route::post('materi/simpan', [MateriCOntroller::class, 'simpan'])->name('admin.kelas.simpan');
    Route::get('materi/detail/{id}', [MateriCOntroller::class, 'detail'])->name('admin.kelas.detail');
    Route::get('materi/hapus/{id}', [MateriCOntroller::class, 'hapus'])->name('admin.kelas.hapus');
    Route::get('materi/edit/{id}', [MateriCOntroller::class, 'edit'])->name('admin.kelas.edit');
    Route::post('materi/update/{id}', [MateriCOntroller::class, 'update'])->name('admin.kelas.update');
    Route::get('materi/tambahvideo', [MateriCOntroller::class, 'tambahvideo'])->name('admin.kelas.tambahvideo');
    Route::post('materi/simpanvideo', [MateriCOntroller::class, 'simpanvideo'])->name('admin.kelas.simpanvideo');
    Route::get('materi/hapusvideo/{id}', [MateriCOntroller::class, 'hapusvideo'])->name('admin.kelas.hapusvideo');

    Route::get('/ujian', [UjianController::class, 'pilihMapel']);
    Route::get('/ujian/{id}', [UjianController::class, 'mulaiUjian'])->name('mulaiUjian');
    Route::post('/kirim-jawaban', [UjianController::class, 'kirimJawaban']);

    Route::get('/daftar-nilai', [UjianController::class, 'daftarNilai'])->name('daftarNilai');

    Route::get('/nilai-siswa', [NilaiController::class, 'index'])->name('nilai-siswa');
    Route::get('/nilai-siswa/{id}', [NilaiController::class, 'nilai'])->name('daftar-nilai-siswa');

    //Blog
    Route::get('/admin/blog', [BlogController::class, 'index'])->name('admin.blog');
    Route::get('/admin/blog/tambah', [BlogController::class, 'tambah'])->name('admin.blog.tambah');
    Route::post('/admin/blog/simpan', [BlogController::class,'simpan'])->name('admin.blog.simpan');
    Route::get('/admin/blog/hapus/{id}', [BlogController::class,'hapus'])->name('admin.blog.hapus');
    Route::get('/admin/blog/detail/{id}', [BlogController::class,'detail'])->name('admin.blog.detail');
    Route::get('/admin/blog/edit/{id}', [BlogController::class,'edit'])->name('admin.blog.edit');
    Route::post('/admin/blog/update/{id}', [BlogController::class,'update'])->name('admin.blog.update');
});