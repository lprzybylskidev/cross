<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/test', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('test');

require __DIR__.'/auth.php';
