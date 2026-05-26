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

        $csp = implode(' ', [
            "default-src 'self';",
            "script-src 'self' 'unsafe-inline' cdn.ckeditor.com;",
            "style-src 'self' 'unsafe-inline' fonts.googleapis.com;",
            "font-src 'self' fonts.gstatic.com data:;",
            "img-src 'self' data: blob:;",
            "frame-src 'self' www.google.com;",
            "object-src 'none';",
            "base-uri 'self';",
            "form-action 'self';",
        ]);

        $response->headers->set('Content-Security-Policy', $csp);

        // ── Cegah Clickjacking ──────────────────────────────────────────────
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // ── Cegah MIME sniffing ─────────────────────────────────────────────
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // ── Referrer Policy ─────────────────────────────────────────────────
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // ── Matikan fitur browser yang tidak dipakai ────────────────────────
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=(), payment=()'
        );

        return $response;
    }
}
