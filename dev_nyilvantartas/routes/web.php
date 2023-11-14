<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
//sima oldal route
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->status === 'admin') {
            return view('dashboard-admin');
        } else {
            return view('dashboard-user');
        }
    })->name('dashboard');
    Route::get('/admin-only', function () {
        if (auth()->user()->status === 'admin') {
            return view('admin-only');
        } else {
            return view('user-img');
        }
    })->name('admin.only');
});



