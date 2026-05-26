<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // ── CSP & HSTS hanya aktif di production ────────────────────────────
        // Di local development (APP_ENV=local), Vite dev server berjalan di
        // http://localhost:5173 — CSP akan memblokir semua asset Vite jika
        // diaktifkan, sehingga tampilan akan kacau.
        if (config('app.env') === 'production') {

            // ── Content Security Policy ─────────────────────────────────────
            // 'unsafe-inline' pada script-src diperlukan oleh CKEditor 5.
            $csp = implode(' ', [
                "default-src 'self';",
                "script-src 'self' 'unsafe-inline' cdn.ckeditor.com;",
                "style-src 'self' 'unsafe-inline' fonts.googleapis.com;",
                "font-src 'self' fonts.gstatic.com data:;",
                "img-src 'self' data: blob:;",
                "connect-src 'self';",
                "frame-src 'self' www.google.com;",
                "object-src 'none';",
                "base-uri 'self';",
                "form-action 'self';",
                "upgrade-insecure-requests;",
            ]);

            $response->headers->set('Content-Security-Policy', $csp);

            // ── HSTS: paksa HTTPS selama 1 tahun ───────────────────────────
            $response->headers->set(
                'Strict-Transport-Security',
                'max-age=31536000; includeSubDomains'
            );
        }

        // ── Header berikut aman diaktifkan di semua environment ─────────────

        // Cegah Clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Cegah MIME sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Referrer Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Matikan fitur browser yang tidak dipakai
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=(), payment=()'
        );

        // Hapus header yang membocorkan info server
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        return $response;
    }
}
