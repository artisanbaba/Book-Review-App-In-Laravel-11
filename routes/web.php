<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserReviewController;

// Home Controller Routes
Route::controller(HomeController::class)->group(function () {
    // Home Page
    Route::get('/', 'index')->name('home');

    // Book Detail Page
    Route::get('/book/{id}', 'bookDetail')->name('book.detail');

    // Save Book Review
    Route::post('/save-review', 'saveReview')->name('book.saveReview');
});

// Account Routes
Route::group(['prefix' => 'account'], function () {

    // Public Routes
    Route::group(['middleware' => 'guest'], function () {

        Route::get('register', [AuthController::class, 'showRegister'])->name('account.showRegister');
        Route::put('register', [AuthController::class, 'register'])->name('account.register');

        Route::get('login', [AuthController::class, 'showLogin'])->name('account.showLogin');
        Route::post('login', [AuthController::class, 'authenticate'])->name('account.authenticate');
    });

    // Protected Routes
    Route::group(['middleware' => 'auth'], function () {
        // User Profile Routes
        Route::get('profile', [UserController::class, 'show'])->name('account.showProfile');
        Route::get('profile/edit', [UserController::class, 'edit'])->name('account.editProfile');
        Route::post('profile/update', [UserController::class, 'update'])->name('account.updateProfile');

        // Change Password Routes
        Route::get('change-password', [UserController::class, 'changePassword'])->name('account.changePassword');

        Route::post('change-password/update', [UserController::class, 'updatePassword'])->name('account.updatePassword');


        // Logout Route
        Route::get('logout', [AuthController::class, 'logout'])->name('account.logout');

        // User Reviews Management
        Route::resource('user-reviews', UserReviewController::class);

        Route::group(['middleware' => 'check-admin'], function () {
            // Admin Routes for Books and Reviews Management
            Route::resources([
                'books' => BookController::class,
                'reviews' => ReviewController::class
            ]);
        });
    });
});
