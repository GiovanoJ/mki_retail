@extends('layouts.auth')

@section('title', 'Login Admin')

@section('content')

    <h2 class="text-white font-semibold text-xl mb-1">Selamat datang</h2>
    <p class="text-gray-400 text-sm mb-6">Masuk ke panel admin MyStore</p>

    @if (session('error'))
        <div class="flex items-center gap-2 bg-red-500/10 border border-red-500/30 text-red-400 text-xs px-4 py-3 rounded-lg mb-5">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    @if (session('throttle_error'))
        <div class="flex items-center gap-2 bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs px-4 py-3 rounded-lg mb-5">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            {{ session('throttle_error') }}
        </div>
    @endif

    <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="username" class="block text-xs font-medium text-gray-400 mb-1.5">Username</label>
            <input type="text" id="username" name="username"
                   value="{{ old('username') }}" required autofocus
                   placeholder="Masukkan username"
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                          focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                          @error('username') border-red-500 @enderror">
            @error('username')
                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-xs font-medium text-gray-400 mb-1.5">Password</label>
            <input type="password" id="password" name="password" required
                   placeholder="••••••••"
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                          focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                          @error('password') border-red-500 @enderror">
            @error('password')
                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full bg-violet-600 hover:bg-violet-500 text-white text-sm font-medium py-2.5 rounded-lg transition-colors mt-2">
            Masuk
        </button>
    </form>

    <p class="text-center text-xs text-gray-500 mt-5">
        Belum punya akun?
        <a href="{{ route('admin.register') }}" class="text-violet-400 hover:text-violet-300 transition-colors">Daftar di sini</a>
    </p>

@endsection
