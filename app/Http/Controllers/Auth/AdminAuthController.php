<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        
        if (! Auth::guard('admin')->attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password'],
        ], $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'Username atau password salah.']);
        }

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Selamat datang, ' . Auth::guard('admin')->user()->name . '!');
    }

    public function showRegister()
    {
        return view('auth.admin-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:100'],
            'username'      => ['required', 'string', 'max:50', 'unique:admins,username', 'alpha_dash'],
            'email'         => ['required', 'email', 'unique:admins,email'],
            'password'      => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'register_code' => ['required', 'string'],
        ]);

        if ($request->register_code !== config('admin.register_code')) {
            return back()
                ->withInput($request->except('password', 'password_confirmation', 'register_code'))
                ->withErrors(['register_code' => 'Kode registrasi tidak valid.']);
        }

        Admin::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.login')
            ->with('success', 'Akun admin berhasil dibuat. Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Anda telah logout.');
    }
}
