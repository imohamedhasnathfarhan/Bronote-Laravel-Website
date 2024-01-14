<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NoteController;

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

// Registration Routes
Route::get('/', [RegisterController::class, 'create'])->name('home');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

// Login Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/check', [LoginController::class, 'check'])->name('check');

// Note Routes
Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');

