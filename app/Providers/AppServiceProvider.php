<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('admin-login', function (Request $request) {
            return Limit::perMinutes(15, 5)
                ->by($request->ip())
                ->response(function (Request $request, array $headers) {
                    $retryAfter = $headers['Retry-After'] ?? 900;
                    $minutes    = ceil($retryAfter / 60);

                    return redirect()->route('admin.login')
                        ->with('throttle_error', "Terlalu banyak percobaan gagal. Coba lagi dalam {$minutes} menit.");
                });
    });
    }
}
