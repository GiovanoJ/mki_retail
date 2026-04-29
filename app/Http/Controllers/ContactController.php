<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts('contact:' . $request->ip(), 5)) {
            return back()->withErrors(['message' => 'Terlalu banyak permintaan. Coba lagi dalam beberapa menit.']);
        }
        \Illuminate\Support\Facades\RateLimiter::hit('contact:' . $request->ip(), 600);
        
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:30'],
            'subject' => ['nullable', 'string', 'max:100'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ]);

        try {
            $subject = $validated['subject'] ?? 'Pesan dari Website';
            $name    = $validated['name'];
            $email   = $validated['email'];
            $phone   = $validated['phone'] ?? '-';
            $message = $validated['message'];

            $body  = "Pesan baru dari website PT. Mega Komposit Indonesia\n\n";
            $body .= "Nama     : {$name}\n";
            $body .= "Email    : {$email}\n";
            $body .= "Telepon  : {$phone}\n";
            $body .= "Keperluan: {$subject}\n\n";
            $body .= "Pesan:\n{$message}\n";

            Mail::raw($body, function ($mail) use ($validated, $subject, $name, $email) {
                $mail
                    ->to(config('mail.contact_address', 'info@megakomposit.com'))
                    ->replyTo($email, $name)
                    ->subject("[Website] {$subject} — dari {$name}");
            });

            return redirect()
                ->route('contact')
                ->with('mail_success', true);

        } catch (\Exception $e) {
            \Log::error('Contact form mail failed: ' . $e->getMessage());

            return redirect()
                ->route('contact')
                ->withInput()
                ->with('mail_error', true);
        }
    }
}
