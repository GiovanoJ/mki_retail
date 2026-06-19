@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('subtitle', 'Buat kategori produk baru')

@section('content')

<div class="max-w-lg">

    <form action="{{ route('admin.product-categories.store') }}" method="POST">
        @csrf

        <div class="bg-gray-900 border border-gray-800 rounded-xl p-5 space-y-5">

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">
                    Nama Kategori <span class="text-red-400">*</span>
                </label>
                <input type="text" name="label" value="{{ old('label') }}" required
                       autofocus
                       placeholder="Contoh: Atap Spandek"
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                              @error('label') border-red-500 @enderror">
                <p class="text-xs text-gray-600 mt-1">Slug akan dibuat otomatis dari nama ini.</p>
                @error('label') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Urutan Tampil</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" min="0"
                       class="w-32 bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
                <p class="text-xs text-gray-600 mt-1">Angka lebih kecil tampil lebih dulu di tab.</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Tampil di Tab Produk</label>
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" name="show_in_tab" value="1"
                               {{ old('show_in_tab', true) ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-10 h-6 bg-gray-700 peer-checked:bg-violet-600 rounded-full transition-colors"></div>
                        <div class="absolute top-1 left-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4 pointer-events-none"></div>
                    </div>
                    <span class="text-sm text-gray-300">Tampilkan sebagai tab di halaman produk publik</span>
                </label>
                <p class="text-xs text-gray-600 mt-1.5">
                    Jika dimatikan, kategori ini tetap bisa dipilih saat membuat/edit produk,
                    tapi tidak akan muncul sebagai tab filter di halaman produk publik.
                </p>
            </div>

        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('admin.product-categories.index') }}"
               class="text-xs text-gray-500 hover:text-gray-300 transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="bg-violet-600 hover:bg-violet-500 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">
                Simpan Kategori
            </button>
        </div>

    </form>
</div>

@endsection
