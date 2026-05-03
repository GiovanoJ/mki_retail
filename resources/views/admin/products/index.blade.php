@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('subtitle', 'Daftar semua produk di toko')

@section('content')

    {{-- Header row --}}
    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-3">
            <form method="GET" action="{{ route('admin.products.index') }}" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari produk..."
                       class="bg-gray-800 border border-gray-700 rounded-lg px-3 py-1.5 text-sm text-white placeholder-gray-600
                              focus:outline-none focus:border-violet-500 transition-colors w-48">
                <button type="submit"
                        class="text-xs text-gray-400 hover:text-white border border-gray-700 px-3 py-1.5 rounded-lg transition-colors">
                    Cari
                </button>
            </form>
            <span class="text-xs text-gray-500 bg-gray-800 border border-gray-700 px-3 py-1.5 rounded-lg">
                {{ $products->total() }} produk
            </span>
        </div>
        <a href="{{ route('admin.products.create') }}"
           class="flex items-center gap-2 bg-violet-600 hover:bg-violet-500 text-white text-sm px-4 py-2 rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Produk
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-800">
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Nama</th>
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Kategori</th>
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Harga</th>
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Varian / Stok</th>
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Status</th>
                    <th class="text-right text-xs font-medium text-gray-500 px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-800/40 transition-colors">

                        {{-- Name + thumbnail --}}
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                @php $thumb = $product->firstImage(); @endphp
                                @if($thumb)
                                    <img src="{{ asset('storage/' . $thumb) }}"
                                         class="w-9 h-9 object-cover rounded-lg border border-gray-700 shrink-0"
                                         alt="{{ $product->name }}">
                                @else
                                    <div class="w-9 h-9 rounded-lg border border-gray-700 bg-gray-800 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-gray-200 font-medium leading-tight">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">ID #{{ $product->id }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Categories --}}
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-1">
                                @forelse($product->categoryLabels() as $label)
                                    <span class="text-xs bg-gray-800 border border-gray-700 text-gray-300 px-2 py-0.5 rounded-md">
                                        {{ $label }}
                                    </span>
                                @empty
                                    <span class="text-xs text-gray-600">—</span>
                                @endforelse
                            </div>
                        </td>

                        {{-- Price --}}
                        <td class="px-4 py-3 text-gray-300">{{ $product->formattedPrice() }}</td>

                        {{-- Variants / stock --}}
                        <td class="px-4 py-3">
                            @php
                                $variantCount = $product->variants->count();
                                $totalStock   = $product->variants->where('is_active', true)->sum('stock');
                            @endphp
                            <p class="text-xs text-gray-300">{{ $variantCount }} varian</p>
                            <p class="text-xs mt-0.5 {{ $totalStock == 0 && $variantCount > 0 ? 'text-red-400' : 'text-gray-500' }}">
                                Stok: {{ $totalStock }}
                                @if($totalStock == 0 && $variantCount > 0)
                                    <span class="ml-1 bg-red-500/15 text-red-400 border border-red-500/30 px-1.5 py-0.5 rounded">Habis</span>
                                @elseif($totalStock > 0 && $totalStock <= 5)
                                    <span class="ml-1 bg-amber-500/15 text-amber-400 border border-amber-500/30 px-1.5 py-0.5 rounded">Sedikit</span>
                                @endif
                            </p>
                        </td>

                        {{-- Status --}}
                        <td class="px-4 py-3">
                            @if($product->is_active)
                                <span class="inline-flex items-center gap-1 text-xs bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 px-2.5 py-1 rounded-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-xs bg-gray-700/50 text-gray-400 border border-gray-700 px-2.5 py-1 rounded-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.variants.index', $product) }}"
                                   class="text-xs text-gray-400 hover:text-white bg-gray-800 hover:bg-gray-700 border border-gray-700 px-3 py-1.5 rounded-lg transition-colors">
                                    Varian
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="text-xs text-gray-400 hover:text-white bg-gray-800 hover:bg-gray-700 border border-gray-700 px-3 py-1.5 rounded-lg transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('Hapus produk ini beserta semua variannya? Tindakan tidak bisa dibatalkan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-xs text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 border border-red-500/30 px-3 py-1.5 rounded-lg transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                                </svg>
                                <p class="text-sm text-gray-500">Belum ada produk</p>
                                <a href="{{ route('admin.products.create') }}" class="text-xs text-violet-400 hover:text-violet-300 transition-colors">
                                    Tambah produk pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($products->hasPages())
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    @endif

@endsection
