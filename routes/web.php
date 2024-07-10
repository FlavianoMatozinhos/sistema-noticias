<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('blog/{id}',   'post')->name('post');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'admin'])->name('dashboard');


Route::middleware('auth')->group(function(){
    Route::resource('posts', PostController::class)->except('show');
}); 


require __DIR__.'/auth.php';
