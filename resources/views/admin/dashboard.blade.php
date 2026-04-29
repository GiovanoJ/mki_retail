@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Ringkasan toko Anda hari ini')

@section('content')

    {{-- Stat cards --}}
    <div class="grid grid-cols-3 gap-4 mb-8">

        <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-medium text-gray-400">Total Produk</p>
                <div class="w-8 h-8 bg-violet-500/15 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-violet-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ $stats['total_products'] }}</p>
            <p class="text-xs text-gray-500 mt-1">produk terdaftar</p>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-medium text-gray-400">Produk Aktif</p>
                <div class="w-8 h-8 bg-emerald-500/15 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ $stats['active_products'] }}</p>
            <p class="text-xs text-gray-500 mt-1">tampil di toko</p>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-medium text-gray-400">Stok Habis</p>
                <div class="w-8 h-8 bg-amber-500/15 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ $stats['out_of_stock'] }}</p>
            <p class="text-xs text-gray-500 mt-1">perlu restock</p>
        </div>
    </div>

    {{-- Quick actions --}}
    <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
        <h3 class="text-sm font-semibold text-white mb-4">Aksi Cepat</h3>
        <div class="flex gap-3">
            <a href="{{ route('admin.products.index') }}"
               class="flex items-center gap-2 bg-gray-800 hover:bg-gray-700 border border-gray-700 text-gray-300 text-sm px-4 py-2.5 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                Kelola Produk
            </a>
            <a href="{{ route('admin.products.create') }}"
               class="flex items-center gap-2 bg-violet-600 hover:bg-violet-500 text-white text-sm px-4 py-2.5 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Produk Baru
            </a>
        </div>
    </div>

@endsection
