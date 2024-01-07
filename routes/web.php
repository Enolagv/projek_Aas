<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\LetterTypeController;
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

Route::middleware('IsGuest')->group(function() {
    Route::get('/', function () {
        return view('login');
    })->name('login');
    
    Route::post('/login', [UserController::class, 'authlogin'])->name('auth-login');
});

Route::middleware('IsLogin')->group(function() {
    Route::get('/logout', [UserController::class, 'logout'])->name('auth-logout');

    Route::get('/dashboard', function() {
        return view('dashboard');
    });

    Route::prefix('/user')->name('user.')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('dashboard');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/data', [UserController::class, 'index'])->name('data');
        Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
    });
    

    Route::prefix('/staff')->name('staff.')->group(function() {
        Route::get('/', [StaffController::class, 'index'])->name('dashboard');
        Route::get('/create', [StaffController::class, 'create'])->name('create');
        Route::post('/store', [StaffController::class, 'store'])->name('store');
        Route::get('/data', [StaffController::class, 'index'])->name('data');
        Route::get('/{id}', [StaffController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [StaffController::class, 'update'])->name('update');
        Route::delete('/{id}', [StaffController::class, 'destroy'])->name('delete');
    });

    Route::prefix('/letterType')->name('letterType.')->group(function() {
        Route::get('/', [LetterTypeController::class, 'index'])->name('dashboard');
        Route::get('/create', [LetterTypeController::class, 'create'])->name('create');
        Route::post('/store', [LetterTypeController::class, 'store'])->name('store');
        Route::get('/data', [LetterTypeController::class, 'index'])->name('data');
        Route::get('/{id}', [LetterTypeController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [LetterTypeController::class, 'update'])->name('update');
        Route::delete('/{id}', [LetterTypeController::class, 'destroy'])->name('delete');
        Route::get('/download-excel', [LetterTypeController::class, 'downloadExcel'])->name('download-excel');
    });
    Route::prefix('/letter')->name('letter.')->group(function() {
        Route::get('/', [LetterController::class, 'index'])->name('dashboard');
        Route::get('/create', [LetterController::class, 'create'])->name('create');
        Route::post('/store', [LetterController::class, 'store'])->name('store');
        Route::get('/data', [LetterController::class, 'index'])->name('data');
        Route::get('/{id}', [LetterController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [LetterController::class, 'update'])->name('update');
        Route::delete('/{id}', [LetterController::class, 'destroy'])->name('delete');
        Route::get('/print/{id}', [LetterController::class, 'show'])->name('print');
        Route::get('/download/{id}', [LetterController::class, 'downloadPDF'])->name('download');
    });

    Route::prefix('/guru')->name('guru.')->group(function() {
        Route::get('/', [GuruController::class, 'index'])->name('dashboard');
        Route::get('/create', [GuruController::class, 'create'])->name('create');
        Route::post('/store', [GuruController::class, 'store'])->name('store');
        Route::get('/data', [GuruController::class, 'index'])->name('data');
        Route::get('/{id}', [GuruController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [GuruController::class, 'update'])->name('update');
        Route::delete('/{id}', [GuruController::class, 'destroy'])->name('delete');
    });
});

