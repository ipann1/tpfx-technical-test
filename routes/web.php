<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('home', ['title' => 'Home']);
    })->middleware('auth');

    Route::get('/users', [UserController::class, 'index']);

    Route::post('/users', [UserController::class, 'add'])->name('users.add');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');

    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/logout', function () {
    return redirect('/login');
});
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');
