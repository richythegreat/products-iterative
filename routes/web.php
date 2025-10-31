<?php

use Illuminate\Support\Facades\Route;


Route::resource('/products', [PostController::class]);

Route::get('/', function () {
    return view('welcome');
});