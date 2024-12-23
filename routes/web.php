<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommunicationControllers\MessagesController;
use App\Http\Controllers\CourseControllers\CourseChapterLessonController;
use App\Http\Controllers\CourseControllers\CourseChaptersController;
use App\Http\Controllers\CourseControllers\CourseCommissionController;
use App\Http\Controllers\CourseControllers\CourseController;
use App\Http\Controllers\CourseControllers\CourseCouponController;
use App\Http\Controllers\CourseControllers\CourseReviewsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CommunicationControllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

// Guest Routes
Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated Routes
Route::middleware('auth')->group(function (): void {

    // Super Admin - Access Everything
    Route::middleware('role:super-admin')->group(function () {
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

        // Courses -> Chapters
        Route::get('/courses/{course}/chapters', [CourseChaptersController::class, 'index'])
            ->name('course.chapters.index');
        Route::post('/courses/{course}/chapters', [CourseChaptersController::class, 'store'])->name('course.chapters.store');
        Route::put('/courses/{course}/chapters/{chapter}', [CourseChaptersController::class, 'update'])
            ->name('course.chapters.update');
        Route::delete('/courses/{course}/chapters/{chapter}', [CourseChaptersController::class, 'destroy'])
            ->name('course.chapters.destroy');

        // Courses -> Chapters -> Lessons
        Route::get('/courses/{course}/chapters/{chapter}/lessons', [CourseChapterLessonController::class, 'index'])
            ->name('course.chapters.lessons.index');
        Route::get('/courses/{course}/chapters/{chapter}/lessons/create', [CourseChapterLessonController::class, 'create'])
            ->name('course.chapters.lessons.create');
        Route::post('/courses/{course}/chapters/{chapter}/lessons', [CourseChapterLessonController::class, 'store'])
            ->name('course.chapters.lessons.store');
        Route::get('/courses/{course}/chapters/{chapter}/lessons/{lesson}/edit', [CourseChapterLessonController::class, 'edit'])
            ->name('course.chapters.lessons.edit');
        Route::put('/courses/{course}/chapters/{chapter}/lessons/{lesson}', [CourseChapterLessonController::class, 'update'])
            ->name('course.chapters.lessons.update');
        Route::delete('/courses/{course}/chapters/{chapter}/lessons/{lesson}', [CourseChapterLessonController::class, 'destroy'])
            ->name('course.chapters.lessons.destroy');

        // Courses -> Coupons
        Route::get('/courses/{course}/coupons', [CourseCouponController::class, 'index'])
            ->name('course.coupons.index');
        Route::get('/courses/{course}/coupons/create', [CourseCouponController::class, 'create'])->name('course.coupons.create');
        Route::post('/courses/{course}/coupons', [CourseCouponController::class, 'store'])->name('course.coupons.store');
        Route::get('/coupons/{coupon}/edit', [CourseCouponController::class, 'edit'])->name('course.coupons.edit');
        Route::put('/coupons/{coupon}', [CourseCouponController::class, 'update'])->name('course.coupons.update');
        Route::delete('/coupons/{coupon}', [CourseCouponController::class, 'destroy'])->name('course.coupons.destroy');

        // Communication -> Reviews
        Route::get('/communication/reviews', [ReviewController::class, 'index'])->name('communications.reviews.index');
        Route::delete('/communication/reviews/{review}', [ReviewController::class, 'destroy'])->name('communications.reviews.destroy');

        // Communication -> Messages
        Route::get('/communication/messages', [MessagesController::class, 'index'])->name('communications.messages.index');
        Route::get('/communication/messages/{user}', [MessagesController::class, 'chat_index'])->name('communications.messages.chat.index');
        Route::post('/communication/messages/chat', [MessagesController::class, 'chat_store'])->name('communications.messages.chat.store');

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    });

    // Admin - Limited Access
    Route::middleware('role:admin')->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class);
    });

    // Mentor - Limited to Dashboard, Courses, and Communications
    Route::middleware('role:mentor')->group(function () {
        // Courses
        Route::resource('courses', CourseController::class);

        // Courses -> Commissions
        Route::get('/courses/{course}/commissions', [CourseCommissionController::class, 'index'])
            ->name('course.commissions.index');

        // Courses -> Reviews
        Route::get('/courses/{course}/reviews', [CourseReviewsController::class, 'index'])
            ->name('course.reviews.index');

        // Courses -> Chapters
        Route::get('/courses/{course}/chapters', [CourseChaptersController::class, 'index' ])
            ->name('course.chapters.index');
        Route::post('/courses/{course}/chapters', [CourseChaptersController::class, 'store'])->name('course.chapters.store');
        Route::put('/courses/{course}/chapters/{chapter}', [CourseChaptersController::class, 'update'])
            ->name('course.chapters.update');
        Route::delete('/courses/{course}/chapters/{chapter}', [CourseChaptersController::class, 'destroy'])
            ->name('course.chapters.destroy');

        // Courses -> Chapters -> Lessons
        Route::get('/courses/{course}/chapters/{chapter}/lessons', [CourseChapterLessonController::class, 'index'])
            ->name('course.chapters.lessons.index');
        Route::get('/courses/{course}/chapters/{chapter}/lessons/create', [CourseChapterLessonController::class, 'create'])
            ->name('course.chapters.lessons.create');
        Route::post('/courses/{course}/chapters/{chapter}/lessons', [CourseChapterLessonController::class, 'store'])
            ->name('course.chapters.lessons.store');
        Route::get('/courses/{course}/chapters/{chapter}/lessons/{lesson}/edit', [CourseChapterLessonController::class, 'edit'])
            ->name('course.chapters.lessons.edit');
        Route::put('/courses/{course}/chapters/{chapter}/lessons/{lesson}', [CourseChapterLessonController::class, 'update'])
            ->name('course.chapters.lessons.update');
        Route::delete('/courses/{course}/chapters/{chapter}/lessons/{lesson}', [CourseChapterLessonController::class, 'destroy'])
            ->name('course.chapters.lessons.destroy');

        // Courses -> Coupons
        Route::get('/courses/{course}/coupons', [CourseCouponController::class, 'index'])
            ->name('course.coupons.index');
        Route::get('/courses/{course}/coupons/create', [CourseCouponController::class, 'create'])->name('course.coupons.create');
        Route::post('/courses/{course}/coupons', [CourseCouponController::class, 'store'])->name('course.coupons.store');
        Route::get('/coupons/{coupon}/edit', [CourseCouponController::class, 'edit'])->name('course.coupons.edit');
        Route::put('/coupons/{coupon}', [CourseCouponController::class, 'update'])->name('course.coupons.update');
        Route::delete('/coupons/{coupon}', [CourseCouponController::class, 'destroy'])->name('course.coupons.destroy');

        // Communication -> Reviews
        Route::get('/communication/reviews', [ReviewController::class, 'index'])->name('communications.reviews.index');
        Route::delete('/communication/reviews/{review}', [ReviewController::class, 'destroy'])->name('communications.reviews.destroy');

        // Communication -> Messages
        Route::get('/communication/messages', [MessagesController::class, 'index'])->name('communications.messages.index');
        Route::get('/communication/messages/{user}', [MessagesController::class, 'chat_index'])->name('communications.messages.chat.index');
        Route::post('/communication/messages/chat', [MessagesController::class, 'chat_store'])->name('communications.messages.chat.store');

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    });
});
