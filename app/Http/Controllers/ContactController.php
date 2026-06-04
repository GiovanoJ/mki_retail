<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        $redirectRoute = $request->input('source') === 'home' ? 'home' : 'contact';

        $ipKey = 'contact-ip:' . $request->ip();
        if (RateLimiter::tooManyAttempts($ipKey, 3)) {
            $seconds = RateLimiter::availableIn($ipKey);
            $minutes = ceil($seconds / 60);
            return back()
                ->withInput()
                ->withErrors(['message' => "Terlalu banyak permintaan. Coba lagi dalam {$minutes} menit."]);
        }

        if ($request->filled('website')) {
            return redirect()->route($redirectRoute)->with('mail_success', true);
        }

        $loadedAt = (int) $request->input('form_loaded_at', 0);
        $elapsed  = time() - $loadedAt;
        if ($loadedAt === 0 || $elapsed < 5) {
            return redirect()->route($redirectRoute)->with('mail_success', true);
        }

        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:30'],
            'subject' => ['nullable', 'string', 'max:100'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ]);

        $recentDuplicate = ContactMessage::where('email', $validated['email'])
            ->where('message', strip_tags($validated['message']))
            ->where('created_at', '>=', now()->subMinutes(10))
            ->exists();

        if ($recentDuplicate) {
            return redirect()->route($redirectRoute)->with('mail_success', true);
        }

        $spamKeywords = [
            'casino', 'viagra', 'crypto', 'bitcoin', 'lottery',
            'prize', 'winner', 'click here', 'buy now', 'free money',
            'make money', 'earn money', 'investment opportunity',
        ];

        $messageLower = strtolower($validated['message'] . ' ' . $validated['name']);
        foreach ($spamKeywords as $keyword) {
            if (str_contains($messageLower, $keyword)) {
                return redirect()->route($redirectRoute)->with('mail_success', true);
            }
        }

        RateLimiter::hit($ipKey, 600);

        ContactMessage::create([
            'name'    => strip_tags($validated['name']),
            'email'   => $validated['email'],
            'phone'   => $validated['phone'] ?? null,
            'subject' => $validated['subject'] ?? null,
            'message' => strip_tags($validated['message']),
        ]);

        return redirect()->route($redirectRoute)->with('mail_success', true);
    }
}
