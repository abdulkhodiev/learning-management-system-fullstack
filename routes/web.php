<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseControllers\CourseCommissionController;
use App\Http\Controllers\CourseControllers\CourseController;
use App\Http\Controllers\CourseControllers\CourseReviewsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware('auth')->group(function (): void {
   Route::resource('roles', RoleController::class);
   Route::resource('permissions', PermissionController::class);
   Route::resource('users', UserController::class);
   Route::resource('categories', CategoryController::class);

   // Courses
   Route::resource('courses', CourseController::class);

   // Courses -> Commissions
   Route::get('/courses/{course}/commissions', [CourseCommissionController::class, 'index'])
   ->name('course.commissions.index');

   // Courses -> Reviews
    Route::get('/courses/{course}/reviews', [CourseReviewsController::class, 'index'])
    ->name('course.reviews.index');

});





