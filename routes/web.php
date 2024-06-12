<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});
Route::get('/', [App\Http\Controllers\Open\CarController::class, 'index'])->name('open.cars.index');



Route::get('open/cars/{car}', [App\Http\Controllers\Open\CarController::class, 'show'])->name('open.cars.show');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' =>['role:moderator|admin']], function ()
{
    Route::get('/admin/cars/{car}/delete', [App\Http\Controllers\Admin\CarController::class, 'delete'])
        ->name('cars.delete');
    Route::resource('/admin/cars', \App\Http\Controllers\Admin\CarController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
