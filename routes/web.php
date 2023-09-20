<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticating']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/students', [StudentController::class, 'index'])->middleware('auth');

Route::get('/student-detail/{id}', [StudentController::class, 'show'])->middleware(['auth', 'must-admin-or-teacher']);

Route::get('/student-add', [StudentController::class, 'create'])->middleware(['auth', 'must-admin-or-teacher']);
Route::post('/student', [StudentController::class, 'store'])->middleware('auth');
Route::get('/student-edit/{id}', [StudentController::class, 'edit'])->middleware(['auth', 'must-admin-or-teacher']);
Route::put('/student/{id}', [StudentController::class, 'update'])->middleware(['auth', 'must-admin-or-teacher']);

Route::get('/student-delete/{id}', [StudentController::class, 'delete'])->middleware(['auth', 'must-admin']);

Route::delete('/student-destroy/{id}', [StudentController::class, 'destroy'])->middleware('auth');
Route::get('/student-deleted', [StudentController::class, 'deletedStudent'])->middleware('auth');
Route::get('/student/{id}/restore', [StudentController::class, 'restore'])->middleware('auth');

Route::get('/class', [ClassController::class, 'index'])->middleware('auth');
Route::get('/class-detail/{id}', [ClassController::class, 'show'])->middleware('auth');
Route::get('/class-add', [ClassController::class, 'create'])->middleware('auth');
Route::post('/class', [ClassController::class, 'store'])->middleware('auth');
Route::get('/class-edit/{id}', [ClassController::class, 'edit'])->middleware('auth');
Route::put('/class/{id}', [ClassController::class, 'update'])->middleware('auth');
Route::get('/class-delete/{id}', [ClassController::class, 'delete'])->middleware('auth');
Route::delete('/class-destroy/{id}', [ClassController::class, 'destroy'])->middleware('auth');

Route::get('/extracurricular', [ExtracurricularController::class, 'index'])->middleware('auth');
Route::get('/extracurricular-detail/{id}', [ExtracurricularController::class, 'show'])->middleware('auth');
Route::get('/extracurricular-add', [ExtracurricularController::class, 'create'])->middleware('auth');
Route::post('/extracurricular', [ExtracurricularController::class, 'store'])->middleware('auth');
Route::get('/extracurricular-edit/{id}', [ExtracurricularController::class, 'edit'])->middleware('auth');
Route::put('/extracurricular/{id}', [ExtracurricularController::class, 'update'])->middleware('auth');
Route::get('/extracurricular-delete/{id}', [ExtracurricularController::class, 'delete'])->middleware('auth');
Route::delete('/extracurricular-destroy/{id}', [ExtracurricularController::class, 'destroy'])->middleware('auth');

Route::get('/teacher', [TeacherController::class, 'index'])->middleware('auth');
Route::get('/teacher-detail/{id}', [TeacherController::class, 'show'])->middleware('auth');
Route::get('/teacher-add', [TeacherController::class, 'create'])->middleware('auth');
Route::post('/teacher', [TeacherController::class, 'store'])->middleware('auth');
Route::get('/teacher-edit/{id}', [TeacherController::class, 'edit'])->middleware('auth');
Route::put('/teacher/{id}', [TeacherController::class, 'update'])->middleware('auth');
Route::get('/teacher-delete/{id}', [TeacherController::class, 'delete'])->middleware('auth');
Route::delete('/teacher-destroy/{id}', [TeacherController::class, 'destroy'])->middleware('auth');

// Route Views
// Route::get('/about', function () {
//     return 'whatever';
// });

// Route::get('/contact', function () {
//     return view('contact', ['name' => 'Daffa Budi Prasetya', 'phone' => '081225011283']);
// });

// Route::view('/contact', 'contact', ['name' => 'Daffa Budi Prasetya', 'phone' => '081225011283']);

// Route Redirect
// Route::redirect('/contact', '/contact-us');

// Route Parameters
// Route::get('/product', function () {
//     return 'product';
// });

// Route::get('/product/{id}', function ($id) {
//     return 'ini adalah produk dengan id ' . $id;
// });

// Route::get('/product/{id}', function ($id) {
//     return view('product.detail', ['id' => $id]);
// });

// Route Prefix
// Route::prefix('administrator')->group(function () {
//     Route::get('/profil-admin', function () {
//         return 'profil admin';
//     });
//     Route::get('/about-admin', function () {
//         return 'about admin';
//     });
//     Route::get('/contact-admin', function () {
//         return 'contact admin';
//     });
//     Route::get('/profil-admin2', function () {
//         return 'profil admin2';
//     });
//     Route::get('/about-admin2', function () {
//         return 'about admin2';
//     });
//     Route::get('/contact-admin2', function () {
//         return 'contact admin2';
//     });
// });
