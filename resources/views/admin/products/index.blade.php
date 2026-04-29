@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('subtitle', 'Daftar semua produk di toko')

@section('content')

    <div class="flex items-center justify-between mb-5">
        <span class="text-xs text-gray-500 bg-gray-800 border border-gray-700 px-3 py-1.5 rounded-lg">
            {{ $products->total() }} produk
        </span>
        <a href="{{ route('admin.products.create') }}"
           class="flex items-center gap-2 bg-violet-600 hover:bg-violet-500 text-white text-sm px-4 py-2 rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Produk
        </a>
    </div>

    <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-800">
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Produk</th>
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Kategori</th>
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Harga Dasar</th>
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Varian</th>
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Total Stok</th>
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Status</th>
                    <th class="text-right text-xs font-medium text-gray-500 px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-800/40 transition-colors">
                        <td class="px-4 py-3">
                            <div>
                                <p class="text-gray-200 font-medium leading-tight">{{ $product->name }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">ID #{{ $product->id }}</p>
                                {{-- Color swatches dari varian --}}
                                @php
                                    $colorVariants = $product->variants->whereNotNull('color_hex')->take(6);
                                @endphp
                                @if($colorVariants->isNotEmpty())
                                    <div class="flex items-center gap-1 mt-1.5">
                                        @foreach($colorVariants as $v)
                                            <div class="w-3.5 h-3.5 rounded-full border border-gray-700 shrink-0"
                                                 style="background-color: {{ $v->color_hex }}"
                                                 title="{{ $v->color_name ?? $v->color_hex }}"></div>
                                        @endforeach
                                        @if($product->variants->whereNotNull('color_hex')->count() > 6)
                                            <span class="text-xs text-gray-600">+{{ $product->variants->whereNotNull('color_hex')->count() - 6 }}</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-xs bg-gray-800 border border-gray-700 text-gray-300 px-2.5 py-1 rounded-md">
                                {{ implode(', ', $product->categoryLabels()) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-300 text-xs">{{ $product->formattedPrice() }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.products.variants.index', $product) }}"
                               class="inline-flex items-center gap-1.5 text-xs text-violet-400 hover:text-violet-300 bg-violet-500/10 hover:bg-violet-500/20 border border-violet-500/30 px-2.5 py-1 rounded-md transition-colors">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                                {{ $product->variants_count }} varian
                            </a>
                        </td>
                        <td class="px-4 py-3">
                            @php $totalStock = $product->variants->where('is_active', true)->sum('stock'); @endphp
                            <span class="{{ $totalStock == 0 ? 'text-red-400' : 'text-gray-300' }}">
                                {{ $totalStock }}
                                @if($totalStock == 0 && $product->variants_count > 0)
                                    <span class="ml-1 text-xs bg-red-500/15 text-red-400 border border-red-500/30 px-1.5 py-0.5 rounded">Habis</span>
                                @endif
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if($product->is_active)
                                <span class="inline-flex items-center gap-1 text-xs bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 px-2.5 py-1 rounded-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-xs bg-gray-700/50 text-gray-400 border border-gray-700 px-2.5 py-1 rounded-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.variants.index', $product) }}"
                                   class="text-xs text-violet-400 hover:text-violet-300 border border-violet-500/30 px-2.5 py-1.5 rounded-lg transition-colors">
                                    Varian
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="text-xs text-gray-400 hover:text-white bg-gray-800 hover:bg-gray-700 border border-gray-700 px-2.5 py-1.5 rounded-lg transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('Hapus produk ini beserta SEMUA variannya?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-xs text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 border border-red-500/30 px-2.5 py-1.5 rounded-lg transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-12 text-center">
                            <svg class="w-8 h-8 text-gray-700 mx-auto mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                            </svg>
                            <p class="text-sm text-gray-500 mb-1">Belum ada produk</p>
                            <a href="{{ route('admin.products.create') }}" class="text-xs text-violet-400 hover:text-violet-300">Tambah produk pertama</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="mt-4">{{ $products->links() }}</div>
    @endif

@endsection
