<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
// use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductVariantController as AdminVariantController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::prefix('products')->name('products.')->group(function () {

    Route::get('/', [ProductController::class, 'index'])
        ->name('index');

    Route::get('/{product}', [ProductController::class, 'show'])
        ->name('show');

});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('admin.guest')->group(function () {

        Route::get('/login', [AdminAuthController::class, 'showLogin'])
            ->name('login');

        Route::post('/login', [AdminAuthController::class, 'login'])
            ->middleware('throttle:admin-login')
            ->name('login.post');

        Route::get('/register', [AdminAuthController::class, 'showRegister'])
            ->name('register');

        Route::post('/register', [AdminAuthController::class, 'register'])
            ->name('register.post');

    });

    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('logout');

});

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware('admin.auth')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | PRODUCTS
        |--------------------------------------------------------------------------
        */

        Route::prefix('products')->name('products.')->group(function () {

            Route::get('/', [AdminProductController::class, 'index'])
                ->name('index');

            Route::get('/create', [AdminProductController::class, 'create'])
                ->name('create');

            Route::post('/', [AdminProductController::class, 'store'])
                ->name('store');

            Route::get('/{product}/edit', [AdminProductController::class, 'edit'])
                ->name('edit');

            Route::put('/{product}', [AdminProductController::class, 'update'])
                ->name('update');

            Route::delete('/{product}', [AdminProductController::class, 'destroy'])
                ->name('destroy');

            Route::prefix('/{product}/variants')
                ->name('variants.')
                ->group(function () {

                    Route::get('/', [AdminVariantController::class, 'index'])
                        ->name('index');

                    Route::get('/create', [AdminVariantController::class, 'create'])
                        ->name('create');

                    Route::post('/', [AdminVariantController::class, 'store'])
                        ->name('store');

                    Route::get('/{variant}/edit', [AdminVariantController::class, 'edit'])
                        ->name('edit');

                    Route::put('/{variant}', [AdminVariantController::class, 'update'])
                        ->name('update');

                    Route::delete('/{variant}', [AdminVariantController::class, 'destroy'])
                        ->name('destroy');

                });

        });

    });
