<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminComplaintController;
use App\Http\Controllers\AdminReportController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/home', function () {
//     return view('login.index');
// });
// Route::get('/dashboard', function () {
//     return view('layouts.main');
// });
// Route::get('/template', function () {
//     return view('assets.index');
// });
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/main', function () {
    // Tambahkan logika atau tampilan yang sesuai di sini
    return view('layouts.main');
})->middleware('auth', 'role.check:2'); // Pastikan hanya pengguna yang terautentikasi yang dapat mengakses halaman ini





Route::middleware(['auth', 'role.check:1'])->group(function () {
    Route::get('/Admin/main', [AdminController::class, 'index'])->name('admin.main');
    Route::get('admin/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('admin/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users', [UserController::class, 'index'])->name('users');

    Route::resource('a_complaint', AdminComplaintController::class);
    Route::get('/admin/a_complaint/indexReport', [AdminComplaintController::class, 'indexReport'])->name('a_complaint.indexReport');
});
Route::middleware(['auth', 'role.check:2'])->group(function () {

    // Menampilkan formulir untuk membuat complaint
    Route::get('/complaints/create', [ComplaintController::class, 'create']);

    // Menyimpan complaint baru
    Route::post('/complaints', [ComplaintController::class, 'store']);

    // Menampilkan daftar semua complaints
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');

    // Menampilkan complaint berdasarkan ID
    Route::get('/complaints/{id}', [ComplaintController::class, 'show']);

    // Menampilkan formulir untuk mengedit complaint
    Route::get('/complaints/{id}/edit', [ComplaintController::class, 'edit']);

    // Menyimpan perubahan pada complaint
    Route::put('/complaints/{id}', [ComplaintController::class, 'update']);

    Route::delete('/complaints/{id}', [ComplaintController::class, 'destroy'])->name('complaints.destroy');
});

Route::middleware(['auth', 'role.check:3'])->group(function () {
    Route::resource('dept', DepartmentController::class);
    Route::resource('d_users', DepartmentUserController::class);
});
