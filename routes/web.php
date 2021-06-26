<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

// Route Task
Route::get('tasks', [TaskController::class, 'index'])->name('tasks')->middleware('auth');

// Route User
Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('auth');
Route::get('cadUser', function () { if(Auth::user()->mod_id === 1) { return view('cadUser'); } })->name('caduser')->middleware('auth');

// Route Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories')->middleware('auth');

require __DIR__.'/auth.php';
