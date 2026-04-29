@extends('layouts.admin')

@section('title', 'Varian Produk')
@section('subtitle', $product->name)

@section('content')

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 mb-5 text-xs text-gray-500">
        <a href="{{ route('admin.products.index') }}" class="hover:text-gray-300 transition-colors">Produk</a>
        <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-300 truncate">{{ $product->name }}</span>
        <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span>Varian</span>
    </nav>

    <div class="bg-gray-900 border border-gray-800 rounded-xl p-4 mb-5 flex items-center justify-between gap-4">
        <div>
            <p class="text-white font-medium">{{ $product->name }}</p>
            <p class="text-xs text-gray-500 mt-0.5">
                {{ implode(', ', $product->category) }} &middot;
                Harga dasar {{ $product->formattedPrice() }} &middot;
                {{ $variants->count() }} varian &middot;
                Total stok: {{ $variants->where('is_active', true)->sum('stock') }}
            </p>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('admin.products.edit', $product) }}"
               class="text-xs text-gray-400 hover:text-white border border-gray-700 hover:border-gray-600 px-3 py-1.5 rounded-lg transition-colors">
                Edit Produk
            </a>
            <a href="{{ route('admin.products.variants.create', $product) }}"
               class="flex items-center gap-1.5 bg-violet-600 hover:bg-violet-500 text-white text-xs px-3 py-1.5 rounded-lg transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Tambah Varian
            </a>
        </div>
    </div>

    {{-- Variants table --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-800">
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">SKU</th>
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Atribut</th>
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Harga</th>
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Stok</th>
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Gambar</th>
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Status</th>
                    <th class="text-right text-xs font-medium text-gray-500 px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse ($variants as $variant)
                    <tr class="hover:bg-gray-800/40 transition-colors">

                        <td class="px-4 py-3">
                            <span class="font-mono text-xs text-violet-300 bg-violet-500/10 border border-violet-500/20 px-2 py-1 rounded">
                                {{ $variant->sku }}
                            </span>
                        </td>

                        <td class="px-4 py-3">
                            @if(!empty($variant->attributes))
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($variant->attributes as $attr)
                                        <span class="inline-flex items-center gap-1.5 text-xs bg-gray-800 border border-gray-700 text-gray-300 px-2 py-0.5 rounded-md">
                                            @if(!empty($attr['hex']))
                                                <span class="w-3 h-3 rounded-full border border-gray-600 shrink-0"
                                                      style="background:{{ $attr['hex'] }}"></span>
                                            @endif
                                            <span class="text-gray-500">{{ $attr['key'] }}:</span>
                                            {{ $attr['value'] }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-xs text-gray-600">—</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            <p class="text-xs text-gray-200">{{ $variant->formattedPrice() }}</p>
                            <p class="text-xs text-gray-600 mt-0.5">{{ $variant->price_override ? 'override' : 'ikut induk' }}</p>
                        </td>

                        <td class="px-4 py-3">
                            <span class="{{ $variant->stock == 0 ? 'text-red-400' : 'text-gray-300' }} text-xs font-mono">
                                {{ $variant->stock }}
                            </span>
                            @if($variant->stock == 0)
                                <span class="ml-1 text-xs bg-red-500/15 text-red-400 border border-red-500/30 px-1.5 py-0.5 rounded">Habis</span>
                            @elseif($variant->stock <= 5)
                                <span class="ml-1 text-xs bg-amber-500/15 text-amber-400 border border-amber-500/30 px-1.5 py-0.5 rounded">Sedikit</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            @if($variant->image_path)
                                <img src="{{ asset('storage/' . $variant->image_path) }}"
                                     class="w-10 h-10 object-cover rounded-lg border border-gray-700"
                                     alt="{{ $variant->sku }}">
                            @else
                                <div class="w-10 h-10 rounded-lg border border-gray-700 bg-gray-800 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                                    </svg>
                                </div>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            @if($variant->is_active)
                                <span class="inline-flex items-center gap-1 text-xs bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 px-2 py-0.5 rounded-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-xs bg-gray-700/50 text-gray-400 border border-gray-700 px-2 py-0.5 rounded-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>Nonaktif
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.variants.edit', [$product, $variant]) }}"
                                   class="text-xs text-gray-400 hover:text-white bg-gray-800 hover:bg-gray-700 border border-gray-700 px-2.5 py-1.5 rounded-lg transition-colors">
                                    Edit
                                </a>
                                <button type="button"
                                        class="delete-variant-btn text-xs text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 border border-red-500/30 px-2.5 py-1.5 rounded-lg transition-colors"
                                        data-sku="{{ $variant->sku }}"
                                        data-action="{{ route('admin.products.variants.destroy', [$product, $variant]) }}">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-14 text-center">
                            <svg class="w-8 h-8 text-gray-700 mx-auto mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 4H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2h-4m-5 0V3m0 1h4"/>
                            </svg>
                            <p class="text-sm text-gray-500 mb-1">Belum ada varian</p>
                            <a href="{{ route('admin.products.variants.create', $product) }}"
                               class="text-xs text-violet-400 hover:text-violet-300 transition-colors">
                                Tambah varian pertama
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ── Delete variant modal ──────────────────────────────────────────────── --}}
    <div id="deleteVariantModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4" style="background:rgba(0,0,0,0.6)">
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 w-full max-w-sm shadow-2xl">
            <div class="flex items-start gap-4 mb-5">
                <div class="w-10 h-10 rounded-full bg-red-500/15 border border-red-500/30 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-white mb-1">Hapus varian ini?</h3>
                    <p class="text-xs text-gray-400 leading-relaxed">
                        Varian <span id="modalVariantSku" class="font-mono text-violet-300"></span>
                        akan dihapus permanen beserta gambarnya. Tindakan ini tidak bisa dibatalkan.
                    </p>
                </div>
            </div>

            <form id="deleteVariantForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex gap-2">
                    <button type="button" id="cancelVariantDeleteBtn"
                            class="flex-1 text-sm text-gray-400 hover:text-white border border-gray-700 hover:border-gray-600 py-2 rounded-lg transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 text-sm font-medium bg-red-600 hover:bg-red-500 text-white py-2 rounded-lg transition-colors">
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
const variantModal = document.getElementById('deleteVariantModal');
const variantForm  = document.getElementById('deleteVariantForm');
const variantSku   = document.getElementById('modalVariantSku');

document.querySelectorAll('.delete-variant-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        variantSku.textContent  = btn.dataset.sku;
        variantForm.action      = btn.dataset.action;
        variantModal.classList.remove('hidden');
    });
});

document.getElementById('cancelVariantDeleteBtn').addEventListener('click', () => {
    variantModal.classList.add('hidden');
});

variantModal.addEventListener('click', (e) => {
    if (e.target === variantModal) variantModal.classList.add('hidden');
});

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') variantModal.classList.add('hidden');
});
</script>
@endpush
