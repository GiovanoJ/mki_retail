@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('subtitle', $category->label)

@section('content')

<nav class="flex items-center gap-2 mb-5 text-xs text-gray-500">
    <a href="{{ route('admin.product-categories.index') }}" class="hover:text-gray-300 transition-colors">Kategori Produk</a>
    <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
    </svg>
    <span>Edit</span>
</nav>

<div class="max-w-lg">

    <form action="{{ route('admin.product-categories.update', $category) }}" method="POST">
        @csrf @method('PUT')

        <div class="bg-gray-900 border border-gray-800 rounded-xl p-5 space-y-5">

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">
                    Nama Kategori <span class="text-red-400">*</span>
                </label>
                <input type="text" name="label" value="{{ old('label', $category->label) }}" required
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                              @error('label') border-red-500 @enderror">
                @error('label') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Slug</label>
                <input type="text" value="{{ $category->slug }}" disabled
                       class="w-full bg-gray-800/50 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-gray-500 font-mono cursor-not-allowed">
                <p class="text-xs text-gray-600 mt-1">Slug tidak bisa diubah agar produk yang sudah memakai kategori ini tetap konsisten.</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Urutan Tampil</label>
                <input type="number" name="order" value="{{ old('order', $category->order) }}" min="0"
                       class="w-32 bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Tampil di Tab Produk</label>
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" name="show_in_tab" value="1"
                               {{ old('show_in_tab', $category->show_in_tab) ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-10 h-6 bg-gray-700 peer-checked:bg-violet-600 rounded-full transition-colors"></div>
                        <div class="absolute top-1 left-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4 pointer-events-none"></div>
                    </div>
                    <span class="text-sm text-gray-300">Tampilkan sebagai tab di halaman produk publik</span>
                </label>
            </div>

            <div class="border-t border-gray-800 pt-4">
                <p class="text-xs text-gray-500">
                    Dipakai oleh <span class="text-gray-300 font-medium">{{ $category->productsCount() }} produk</span>.
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
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>

@endsection
