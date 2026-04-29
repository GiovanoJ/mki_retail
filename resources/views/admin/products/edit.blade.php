@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('subtitle', $product->name)

@section('content')

<nav class="flex items-center gap-2 mb-5 text-xs text-gray-500">
    <a href="{{ route('admin.products.index') }}" class="hover:text-gray-300 transition-colors">Produk</a>
    <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    <a href="{{ route('admin.products.variants.index', $product) }}" class="hover:text-gray-300 transition-colors truncate max-w-[200px]">{{ $product->name }}</a>
    <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    <span>Edit</span>
</nav>

<div class="max-w-2xl">

    <form action="{{ route('admin.products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Informasi Dasar --}}
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-5 space-y-5 mb-4">
            <h3 class="text-sm font-semibold text-white">Informasi Dasar</h3>

            {{-- Nama --}}
            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">
                    Nama Produk <span class="text-red-400">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                              @error('name') border-red-500 @enderror">
                @error('name') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block text-xs font-medium text-gray-400 mb-2">
                    Kategori <span class="text-red-400">*</span>
                    <span class="text-gray-600 font-normal ml-1">— bisa pilih lebih dari satu</span>
                </label>

                @php
                    $selectedStandard = old('category', $product->standardCategorySlugs());
                    $selectedCustom   = old('custom_categories',
                        implode(', ', array_map(
                            fn($s) => ucwords(str_replace(['_','-'],' ',$s)),
                            $product->customCategoryLabels()
                        ))
                    );
                @endphp

                {{-- Checkbox kategori baku --}}
                <div class="grid grid-cols-2 gap-y-2 gap-x-3 mb-3">
                    @foreach($categories as $slug => $label)
                        <label class="flex items-center gap-2.5 cursor-pointer group">
                            <div class="relative w-4 h-4 shrink-0">
                                <input type="checkbox" name="category[]" value="{{ $slug }}"
                                       {{ in_array($slug, $selectedStandard) ? 'checked' : '' }}
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

                {{-- Kategori custom --}}
                <div class="border-t border-gray-800 pt-3">
                    <label class="block text-xs text-gray-500 mb-1.5">
                        Kategori tambahan (manual)
                        <span class="text-gray-600 ml-1">— tidak tampil di tab, hanya di detail produk. Pisahkan dengan koma.</span>
                    </label>
                    <input type="text" name="custom_categories"
                           value="{{ $selectedCustom }}"
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
                <input type="number" name="price" value="{{ old('price', $product->price) }}" min="0" step="100" required
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                              @error('price') border-red-500 @enderror">
                <p class="text-xs text-gray-600 mt-1">Bisa di-override per varian</p>
                @error('price') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Deskripsi</label>
                <textarea name="description" rows="3"
                          class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white
                                 focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors resize-none">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Status</label>
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-10 h-6 bg-gray-700 peer-checked:bg-violet-600 rounded-full transition-colors"></div>
                        <div class="absolute top-1 left-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4 pointer-events-none"></div>
                    </div>
                    <span class="text-sm text-gray-300">Produk aktif (tampil di toko)</span>
                </label>
            </div>
        </div>

        {{-- Spesifikasi Umum --}}
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-5 mb-4">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-sm font-semibold text-white">Spesifikasi Umum</h3>
                    <p class="text-xs text-gray-600 mt-0.5">Berlaku untuk semua varian.</p>
                </div>
                <button type="button" id="addSpecBtn"
                        class="flex items-center gap-1.5 text-xs text-violet-400 hover:text-violet-300 border border-violet-500/30 px-3 py-1.5 rounded-lg transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Tambah
                </button>
            </div>

            <div class="flex items-center gap-2 mb-2 px-1">
                <p class="text-xs text-gray-600 w-[35%]">Nama</p>
                <p class="text-xs text-gray-600 flex-1">Nilai</p>
                <div class="w-7"></div>
            </div>

            <div id="specList" class="space-y-2">
                @php $specs = old('specs', $product->specifications ?? []); @endphp
                @forelse($specs as $i => $spec)
                    <div class="spec-row flex items-center gap-2">
                        <input type="text" name="specs[{{ $i }}][key]"
                               value="{{ $spec['key'] ?? '' }}"
                               placeholder="Contoh: Bahan"
                               class="w-[35%] bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600
                                      focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
                        <span class="text-gray-600">:</span>
                        <input type="text" name="specs[{{ $i }}][value]"
                               value="{{ $spec['value'] ?? '' }}"
                               placeholder="Contoh: Katun 100%"
                               class="flex-1 bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600
                                      focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
                        <button type="button" onclick="this.closest('.spec-row').remove()"
                                class="w-7 h-7 flex items-center justify-center text-gray-600 hover:text-red-400 shrink-0 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                @empty
                    <p class="text-xs text-gray-600 py-2" id="specEmpty">Belum ada spesifikasi. Klik "Tambah" untuk mulai.</p>
                @endforelse
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-between">
            <button type="button" id="deleteProductBtn"
                    class="flex items-center gap-1.5 text-xs text-red-400 hover:text-red-300 border border-red-500/30 hover:border-red-500/60 bg-red-500/5 hover:bg-red-500/10 px-3 py-2 rounded-lg transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Hapus Produk
            </button>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.products.variants.index', $product) }}"
                   class="text-xs text-gray-500 hover:text-gray-300 transition-colors">Batal</a>
                <button type="submit"
                        class="bg-violet-600 hover:bg-violet-500 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </div>

    </form>
</div>

{{-- Delete modal --}}
<div id="deleteModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4" style="background:rgba(0,0,0,0.6)">
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 w-full max-w-sm shadow-2xl">
        <div class="flex items-start gap-4 mb-5">
            <div class="w-10 h-10 rounded-full bg-red-500/15 border border-red-500/30 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white mb-1">Hapus produk ini?</h3>
                <p class="text-xs text-gray-400 leading-relaxed">
                    <span class="text-white font-medium">{{ $product->name }}</span> dan semua variannya akan dihapus permanen.
                </p>
            </div>
        </div>
        <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
            @csrf @method('DELETE')
            <div class="flex gap-2">
                <button type="button" id="cancelDeleteBtn"
                        class="flex-1 text-sm text-gray-400 hover:text-white border border-gray-700 py-2 rounded-lg transition-colors">Batal</button>
                <button type="submit"
                        class="flex-1 text-sm font-medium bg-red-600 hover:bg-red-500 text-white py-2 rounded-lg transition-colors">Ya, Hapus</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
const modal = document.getElementById('deleteModal');
document.getElementById('deleteProductBtn').addEventListener('click', () => modal.classList.remove('hidden'));
document.getElementById('cancelDeleteBtn').addEventListener('click',  () => modal.classList.add('hidden'));
modal.addEventListener('click', e => { if (e.target === modal) modal.classList.add('hidden'); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') modal.classList.add('hidden'); });

let specIdx = {{ count(old('specs', $product->specifications ?? [])) }};

document.getElementById('addSpecBtn').addEventListener('click', () => {
    document.getElementById('specEmpty')?.remove();
    const row = document.createElement('div');
    row.className = 'spec-row flex items-center gap-2';
    row.innerHTML = `
        <input type="text" name="specs[${specIdx}][key]" placeholder="Contoh: Bahan"
               class="w-[35%] bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600
                      focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
        <span class="text-gray-600">:</span>
        <input type="text" name="specs[${specIdx}][value]" placeholder="Contoh: Nilai"
               class="flex-1 bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600
                      focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
        <button type="button" onclick="this.closest('.spec-row').remove()"
                class="w-7 h-7 flex items-center justify-center text-gray-600 hover:text-red-400 shrink-0 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>`;
    document.getElementById('specList').appendChild(row);
    specIdx++;
});
</script>
@endpush
