<?php

use Illuminate\Support\Facades\Route;


Route::resource("permissions",App\Http\Controllers\PermissionController::class);

Route::get('/', function () {
    return Inertia\Inertia::render('Welcome');
});

Route::get('/about', function () {
    return Inertia\Inertia::render('About');
});
