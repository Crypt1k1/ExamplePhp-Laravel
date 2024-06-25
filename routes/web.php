<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});
Route::get('/', [App\Http\Controllers\Open\CarController::class, 'index'])->name('open.cars.index');

//Open
Route::post('open/cars/{car}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('open/cars/{car}', [App\Http\Controllers\Open\CarController::class, 'show'])->name('open.cars.show');

Route::group(['middleware' =>['role:moderator|admin|reader']], function () {
    Route::get('/review/{review}/store', [ReviewController::class, 'store'])->name('rewiews.store');
    Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::post('open/cars/{car}/favorite', [CarController::class, 'toggleFavorite'])->name('cars.favorite.toggle');
    Route::post('user/favourite/{car}', [UserController::class, 'favourite'])->name('user.favourite');
    Route::get('/user/favourites', [UserController::class, 'showFavourites'])->name('user.showFavourites');
    Route::delete('user/favourite/{car}', [UserController::class, 'deleteFavourite'])->name('user.deleteFavourite');

});
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' =>['role:moderator|admin']], function ()
{
    Route::get('/admin/cars/{car}/delete', [App\Http\Controllers\Admin\CarController::class, 'delete'])
        ->name('cars.delete');
    Route::resource('/admin/cars', \App\Http\Controllers\Admin\CarController::class);
});

Route::group(['middleware' =>['role:moderator|admin']], function ()
{
    Route::get('/admin/user/{user}/delete', [UserController::class, 'delete'])
        ->name('user.delete');
    Route::resource('/admin/users', UserController::class);
});
/*
Route::group(['middleware' =>['role:moderator|admin']], function ()
{
    Route::get('/admin/review/{review}/delete', [ReviewController::class, 'delete'])
        ->name('reviews.delete');
    Route::resource('/admin/reviews', ReviewController::class);
});
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
