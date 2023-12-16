<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;



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
    Route::get('/index', [TaskController::class, 'index'])->name('tasks.index');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks/{task}/accept', [TaskController::class, 'acceptTask'])->name('tasks.accept');
    Route::post('/tasks/{task}/finish', [TaskController::class, 'finishTask'])->name('tasks.finish');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/tasks', [TaskController::class, 'adminTasks'])->name('tasks.index');
    Route::delete('/tasks/{task}', [TaskController::class, 'deleteTask'])->name('tasks.delete');
    Route::post('/tasks/{task}/close', [TaskController::class, 'closeTask'])->name('tasks.close');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/accepted-tasks', [UserController::class, 'showAcceptedTasks'])->name('accepted-tasks');
});

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/search-results', [SearchController::class, 'showResults'])->name('search-results');


//Route::middleware(['auth', 'status:admin'])->group(function () {
//    Route::get('/admin/users', [TaskController::class, 'adminUsers'])->name('admin.users.index');
//});


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





