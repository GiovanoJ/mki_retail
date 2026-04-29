@extends('layouts.auth')

@section('title', 'Daftar Admin')

@section('content')

    <h2 class="text-white font-semibold text-xl mb-1">Buat akun admin</h2>
    <p class="text-gray-400 text-sm mb-6">Diperlukan kode registrasi dari superadmin</p>

    <form action="{{ route('admin.register.post') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-xs font-medium text-gray-400 mb-1.5">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                   placeholder="Nama lengkap"
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                          focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                          @error('name') border-red-500 @enderror">
            @error('name') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="username" class="block text-xs font-medium text-gray-400 mb-1.5">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required
                       placeholder="username"
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                              @error('username') border-red-500 @enderror">
                @error('username') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="email" class="block text-xs font-medium text-gray-400 mb-1.5">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       placeholder="admin@email.com"
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                              @error('email') border-red-500 @enderror">
                @error('email') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="password" class="block text-xs font-medium text-gray-400 mb-1.5">Password</label>
            <input type="password" id="password" name="password" required placeholder="Min. 8 karakter, huruf besar, kecil & angka"
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                          focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                          @error('password') border-red-500 @enderror">
            @error('password') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-xs font-medium text-gray-400 mb-1.5">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi password"
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                          focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
        </div>

        <div class="pt-1">
            <label for="register_code" class="block text-xs font-medium text-gray-400 mb-1.5">
                Kode Registrasi Admin
                <span class="ml-1 text-gray-600 font-normal">— dari superadmin</span>
            </label>
            <input type="password" id="register_code" name="register_code" required placeholder="Masukkan kode rahasia"
                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                          focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                          @error('register_code') border-red-500 @enderror">
            @error('register_code') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
                class="w-full bg-violet-600 hover:bg-violet-500 text-white text-sm font-medium py-2.5 rounded-lg transition-colors mt-2">
            Buat Akun Admin
        </button>
    </form>

    <p class="text-center text-xs text-gray-500 mt-5">
        Sudah punya akun?
        <a href="{{ route('admin.login') }}" class="text-violet-400 hover:text-violet-300 transition-colors">Login di sini</a>
    </p>

@endsection
