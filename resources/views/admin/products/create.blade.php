@extends('layouts.admin')

@section('title', 'Produk Baru')
@section('subtitle', 'Isi info dasar, lalu tambahkan varian')

@section('content')

<div class="max-w-xl">

    <div class="flex items-center gap-3 mb-6">
        <div class="flex items-center gap-2">
            <div class="w-6 h-6 rounded-full bg-violet-600 flex items-center justify-center text-xs font-bold text-white shrink-0">1</div>
            <span class="text-xs font-medium text-white">Info Produk</span>
        </div>
        <div class="flex-1 h-px bg-gray-700"></div>
        <div class="flex items-center gap-2">
            <div class="w-6 h-6 rounded-full bg-gray-700 flex items-center justify-center text-xs font-bold text-gray-400 shrink-0">2</div>
            <span class="text-xs text-gray-500">Tambah Varian</span>
        </div>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf

        <div class="bg-gray-900 border border-gray-800 rounded-xl p-5 space-y-5">

            {{-- Nama --}}
            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">
                    Nama Produk <span class="text-red-400">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       placeholder="Contoh: WPC HDPE Ceiling"
                       autofocus
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                              @error('name') border-red-500 @enderror">
                @error('name') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Kategori --}}
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-medium text-gray-400">
                        Kategori
                        <span class="text-gray-600 font-normal ml-1">— bisa pilih lebih dari satu</span>
                    </label>
                    <a href="{{ route('admin.product-categories.index') }}"
                       class="text-xs text-violet-400 hover:text-violet-300 transition-colors">
                        Kelola Kategori
                    </a>
                </div>

                {{-- Checkbox kategori baku (dari tabel product_categories) --}}
                @if(count($categories) > 0)
                    <div class="grid grid-cols-2 gap-y-2 gap-x-3 mb-3">
                        @foreach($categories as $slug => $label)
                            <label class="flex items-center gap-2.5 cursor-pointer group">
                                <div class="relative w-4 h-4 shrink-0">
                                    <input type="checkbox" name="category[]" value="{{ $slug }}"
                                           {{ in_array($slug, old('category', [])) ? 'checked' : '' }}
                                           class="peer absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">
                                    <div class="w-4 h-4 rounded border border-gray-700 bg-gray-800
                                                peer-checked:bg-violet-600 peer-checked:border-violet-600
                                                transition-colors flex items-center justify-center">
                                        <svg class="w-2.5 h-2.5 text-white scale-0 peer-checked:scale-100 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 12 12">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M1.5 6l3 3 6-6"/>
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-sm text-gray-300 group-hover:text-white transition-colors select-none">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                @else
                    <p class="text-xs text-gray-600 mb-3">
                        Belum ada kategori baku. <a href="{{ route('admin.product-categories.create') }}" class="text-violet-400 hover:text-violet-300">Tambah kategori</a> terlebih dahulu.
                    </p>
                @endif

                {{-- Kategori custom / manual --}}
                <div class="border-t border-gray-800 pt-3">
                    <label class="block text-xs text-gray-500 mb-1.5">
                        Kategori tambahan (manual)
                        <span class="text-gray-600 ml-1">— tidak tampil di tab, hanya di detail produk. Pisahkan dengan koma.</span>
                    </label>
                    <input type="text" name="custom_categories"
                           value="{{ old('custom_categories') }}"
                           placeholder="Contoh: WPC Board, Composite Panel"
                           class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                                  focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
                </div>

                @error('category') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Harga --}}
            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">
                    Harga Default (Rp) <span class="text-red-400">*</span>
                </label>
                <input type="number" name="price" value="{{ old('price') }}" min="0" step="100" required
                       placeholder="0"
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                              @error('price') border-red-500 @enderror">
                <p class="text-xs text-gray-600 mt-1">Bisa di-override per varian</p>
                @error('price') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Deskripsi</label>
                <textarea name="description" rows="3"
                          placeholder="Deskripsi singkat produk..."
                          class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                                 focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors resize-none">{{ old('description') }}</textarea>
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Status</label>
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-10 h-6 bg-gray-700 peer-checked:bg-violet-600 rounded-full transition-colors"></div>
                        <div class="absolute top-1 left-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4 pointer-events-none"></div>
                    </div>
                    <span class="text-sm text-gray-300">Produk aktif (tampil di toko)</span>
                </label>
            </div>

        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('admin.products.index') }}"
               class="text-xs text-gray-500 hover:text-gray-300 transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="flex items-center gap-2 bg-violet-600 hover:bg-violet-500 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">
                Lanjut ke Varian
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </button>
        </div>

    </form>
</div>

@endsection
