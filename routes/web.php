<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductVariantController as AdminVariantController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
});

Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/',         [ArticleController::class, 'index'])->name('index');
    Route::get('/{slug}',   [ArticleController::class, 'show'])->name('show');
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('admin.guest')->group(function () {
        Route::get('/login',    [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login',   [AdminAuthController::class, 'login'])
            ->middleware('throttle:admin-login')
            ->name('login.post');
        Route::get('/register', [AdminAuthController::class, 'showRegister'])->name('register');
        Route::post('/register',[AdminAuthController::class, 'register'])->name('register.post');
    });

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

});

Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('products')->name('products.')->group(function () {

        Route::get('/',              [AdminProductController::class, 'index'])->name('index');
        Route::get('/create',        [AdminProductController::class, 'create'])->name('create');
        Route::post('/',             [AdminProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit',[AdminProductController::class, 'edit'])->name('edit');
        Route::put('/{product}',     [AdminProductController::class, 'update'])->name('update');
        Route::delete('/{product}',  [AdminProductController::class, 'destroy'])->name('destroy');

        Route::prefix('/{product}/variants')->name('variants.')->group(function () {
            Route::get('/',              [AdminVariantController::class, 'index'])->name('index');
            Route::get('/create',        [AdminVariantController::class, 'create'])->name('create');
            Route::post('/',             [AdminVariantController::class, 'store'])->name('store');
            Route::get('/{variant}/edit',[AdminVariantController::class, 'edit'])->name('edit');
            Route::put('/{variant}',     [AdminVariantController::class, 'update'])->name('update');
            Route::delete('/{variant}',  [AdminVariantController::class, 'destroy'])->name('destroy');
        });

    });

    Route::prefix('promos')->name('promos.')->group(function () {
        Route::get('/',             [PromoController::class, 'index'])->name('index');
        Route::get('/create',       [PromoController::class, 'create'])->name('create');
        Route::post('/',            [PromoController::class, 'store'])->name('store');
        Route::get('/{promo}/edit', [PromoController::class, 'edit'])->name('edit');
        Route::put('/{promo}',      [PromoController::class, 'update'])->name('update');
        Route::delete('/{promo}',   [PromoController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('articles')->name('articles.')->group(function () {
        Route::get('/',              [AdminArticleController::class, 'index'])->name('index');
        Route::get('/create',        [AdminArticleController::class, 'create'])->name('create');
        Route::post('/',             [AdminArticleController::class, 'store'])->name('store');
        Route::get('/{article}/edit',[AdminArticleController::class, 'edit'])->name('edit');
        Route::put('/{article}',     [AdminArticleController::class, 'update'])->name('update');
        Route::delete('/{article}',  [AdminArticleController::class, 'destroy'])->name('destroy');

        Route::post('/upload-image', [AdminArticleController::class, 'uploadImage'])->name('uploadImage');
        Route::post('/remove-image', [AdminArticleController::class, 'removeImage'])->name('removeImage');
    });
});
