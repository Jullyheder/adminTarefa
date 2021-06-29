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
Route::get('/cadTask', [TaskController::class, 'create'])->name('cadtask')->middleware('auth');

//Route Task Autocomplete
//Route::get('/categoryAutocomplete', [TaskController::class, 'autocomplete'])->name('categoryautocomplete')->middleware('auth');
Route::post('/getautocomplete', [TaskController::class, 'getautocomplete'])->name('getautocomplete')->middleware('auth');

// Route User
Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('auth');
Route::get('/cadUser', function () { if(Auth::user()->mod_id === 1) { return view('cadUser'); } })->name('caduser')->middleware('auth');
Route::get('/editUser/{user}', [UserController::class, 'edit'])->name('edituser')->middleware('auth');
Route::put('/editUser/{user}', [UserController::class, 'update'])->name('updateuser')->middleware('auth');
Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('delUsers');

// Route Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories')->middleware('auth');
Route::get('/cadCategory', [CategoryController::class, 'create'])->name('cadcategory')->middleware('auth');
Route::get('/editCategory/{category}', [CategoryController::class, 'edit'])->name('editcategory')->middleware('auth');
Route::post('/cadCategory', [CategoryController::class, 'store'])->name('inscategory')->middleware('auth');
Route::put('/editCategory/{category}', [CategoryController::class, 'update'])->name('updatecategory')->middleware('auth');
Route::delete('/category/destroy/{category}', [CategoryController::class, 'destroy'])->name('delcategory');

require __DIR__.'/auth.php';
