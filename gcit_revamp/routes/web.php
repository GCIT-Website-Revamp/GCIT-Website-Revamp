<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('contact');
});

Route::get('/new', function () {
    return view('contact');
});
