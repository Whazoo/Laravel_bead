<?php

use App\Http\Controllers\TaskController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/tasks/index', [TaskController::class, 'index'])->name('tasks.index');
});


//Route::middleware(['auth', 'admin'])->group(function () {
//    Route::resource('tasks', TaskController::class);
//});

//Route::middleware(['auth', 'admin'])->group(function () {
   //Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
//});
//Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'admin'])->group(function () {
//    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
//});

//Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');





