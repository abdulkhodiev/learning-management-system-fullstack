<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;


Route::resource("permissions",App\Http\Controllers\PermissionController::class);



Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware('auth')->group(function (): void {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
});





