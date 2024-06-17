<?php

use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});
Route::get('/', [App\Http\Controllers\Open\CarController::class, 'index'])->name('open.cars.index');


Route::post('open/cars/{car}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('open/cars/{car}', [App\Http\Controllers\Open\CarController::class, 'show'])->name('open.cars.show');
Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

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

Route::group(['middleware' =>['role:moderator|admin']], function ()
{
    Route::get('/admin/users/{user}/delete', [App\Http\Controllers\Admin\UserController::class, 'delete'])
        ->name('users.delete');
    Route::resource('/admin/users', \App\Http\Controllers\Admin\UserController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
