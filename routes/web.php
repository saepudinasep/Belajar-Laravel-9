<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\TeacherController;
use App\Models\Extracurricular;

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

// Route::get('/', function () {
//     return view('home', [
//         'name' => 'Asep Saepudin',
//         'role' => 'admin',
//         'buah' => ['pisang', 'apel', 'jeruk', 'semangka', 'kiwi']
//     ]);
// });

// Route::get('/about', function () {
//     return view('about');
// });









// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/about', function () {
//     return 9 * 9;
// });

// Route::get('/contact', function () {
//     return view('contact');
// });

// Route::view('/contact', 'contact', ['name' => 'Asep Saepudin', 'phone' => '085721485664']);

// Route::get('/contact', function () {
//     return view('contact', ['name' => 'Asep Saepudin', 'phone' => '085721485664']);
// });

// Route::redirect('/contact', '/contact-us');

// Route::get('/product', function () {
//     return 'product';
// });


// Route::get('/product/{id}', function ($id) {
//     return view('product.detail', ['id' => $id]);
// });

// untuk memudahkan directori agar tidak panjang
// Route::prefix('admin')->group(function () {
//     Route::get('/profil-admin', function () {
//         return 'profil admin';
//     });

//     Route::get('/about-admin', function () {
//         return 'about admin';
//     });

//     Route::get('/contact-admin', function () {
//         return 'contact admin';
//     });
// });


Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticating'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');



Route::get('/students', [StudentController::class, 'index'])->middleware('auth');
Route::get('/student-detail/{id}', [StudentController::class, 'show'])->middleware(['auth', 'must-admin-or-teacher']);
Route::get('/student-add', [StudentController::class, 'create'])->middleware('auth');
Route::post('/student', [StudentController::class, 'store'])->middleware('auth');
Route::get('/student-edit/{id}', [StudentController::class, 'edit'])->middleware('auth');
Route::put('/student/{id}', [StudentController::class, 'update'])->middleware('auth');
Route::get('/student-delete/{id}', [StudentController::class, 'delete'])->middleware(['auth', 'must-admin']);
Route::delete('/student-destroy/{id}', [StudentController::class, 'destroy'])->middleware('auth');
Route::get('/student-deleted', [StudentController::class, 'deletedStudent'])->middleware('auth');
Route::get('/student/{id}/restore', [StudentController::class, 'restore'])->middleware('auth');

Route::get('/class', [ClassController::class, 'index'])->middleware('auth');
Route::get('/class-detail/{id}', [ClassController::class, 'show'])->middleware('auth');

Route::get('/extracurricular', [ExtracurricularController::class, 'index'])->middleware('auth');
Route::get('/extracurricular-detail/{id}', [ExtracurricularController::class, 'show'])->middleware('auth');

Route::get('/teacher', [TeacherController::class, 'index'])->middleware('auth');
Route::get('/teacher-detail/{id}', [TeacherController::class, 'show'])->middleware('auth');
