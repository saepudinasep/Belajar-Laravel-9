<?php

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
    return view('login');
});

Route::get('/about', function () {
    return 9 * 9;
});

// Route::get('/contact', function () {
//     return view('contact');
// });

// Route::view('/contact', 'contact', ['name' => 'Asep Saepudin', 'phone' => '085721485664']);

Route::get('/contact', function () {
    return view('contact', ['name' => 'Asep Saepudin', 'phone' => '085721485664']);
});
