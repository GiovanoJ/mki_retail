@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('subtitle', 'Daftar semua produk di toko')

@section('content')

    {{-- Header row --}}
    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-3">
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
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Stok</th>
                    <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Status</th>
                    <th class="text-right text-xs font-medium text-gray-500 px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-800/40 transition-colors">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                {{-- Color swatches (if available) --}}
                                @if(!empty($product->colors))
                                    <div class="flex gap-1">
                                        @foreach(array_slice($product->colors, 0, 3) as $color)
                                            <div class="w-4 h-4 rounded-full border border-gray-700 shrink-0"
                                                 style="background-color: {{ $color['hex'] }}"
                                                 title="{{ $color['name'] ?? $color['hex'] }}"></div>
                                        @endforeach
                                        @if(count($product->colors) > 3)
                                            <span class="text-xs text-gray-500">+{{ count($product->colors) - 3 }}</span>
                                        @endif
                                    </div>
                                @endif
                                <div>
                                    <p class="text-gray-200 font-medium leading-tight">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">ID #{{ $product->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-xs bg-gray-800 border border-gray-700 text-gray-300 px-2.5 py-1 rounded-md">
                                {{ $product->category }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-300">{{ $product->formattedPrice() }}</td>
                        <td class="px-4 py-3">
                            <span class="text-gray-300 {{ $product->stock == 0 ? 'text-red-400' : '' }}">
                                {{ $product->stock }}
                                @if($product->stock == 0)
                                    <span class="ml-1 text-xs bg-red-500/15 text-red-400 border border-red-500/30 px-1.5 py-0.5 rounded">Habis</span>
                                @elseif($product->stock <= 5)
                                    <span class="ml-1 text-xs bg-amber-500/15 text-amber-400 border border-amber-500/30 px-1.5 py-0.5 rounded">Sedikit</span>
                                @endif
                            </span>
                        </td>
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
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="text-xs text-gray-400 hover:text-white bg-gray-800 hover:bg-gray-700 border border-gray-700 px-3 py-1.5 rounded-lg transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('Hapus produk ini? Tindakan tidak bisa dibatalkan.')">
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
