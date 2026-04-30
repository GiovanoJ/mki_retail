@extends('layouts.admin')
@section('title', 'Promo / Hero')
@section('subtitle', 'Kelola gambar carousel di halaman produk')

@section('content')
<div class="flex items-center justify-between mb-5">
    <span class="text-xs text-gray-500 bg-gray-800 border border-gray-700 px-3 py-1.5 rounded-lg">
        {{ $promos->count() }} promo
    </span>
    <a href="{{ route('admin.promos.create') }}"
       class="flex items-center gap-2 bg-violet-600 hover:bg-violet-500 text-white text-sm px-4 py-2 rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Promo
    </a>
</div>

<div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-800">
                <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Gambar</th>
                <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Judul / Subtitle</th>
                <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Urutan</th>
                <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Status</th>
                <th class="text-right text-xs font-medium text-gray-500 px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800">
            @forelse($promos as $promo)
                <tr class="hover:bg-gray-800/40 transition-colors">
                    <td class="px-4 py-3">
                        <img src="{{ asset('storage/' . $promo->image_path) }}"
                             class="w-24 h-14 object-cover rounded-lg border border-gray-700"
                             alt="{{ $promo->title }}">
                    </td>
                    <td class="px-4 py-3">
                        <p class="text-gray-200 font-medium">{{ $promo->title ?: '—' }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">{{ Str::limit($promo->subtitle, 60) ?: '—' }}</p>
                    </td>
                    <td class="px-4 py-3 text-gray-400 font-mono text-xs">{{ $promo->order }}</td>
                    <td class="px-4 py-3">
                        @if($promo->is_active)
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
                            <a href="{{ route('admin.promos.edit', $promo) }}"
                               class="text-xs text-gray-400 hover:text-white bg-gray-800 hover:bg-gray-700 border border-gray-700 px-3 py-1.5 rounded-lg transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('admin.promos.destroy', $promo) }}" method="POST"
                                  onsubmit="return confirm('Hapus promo ini?')">
                                @csrf @method('DELETE')
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
                    <td colspan="5" class="px-4 py-12 text-center">
                        <svg class="w-8 h-8 text-gray-700 mx-auto mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                        </svg>
                        <p class="text-sm text-gray-500 mb-1">Belum ada promo</p>
                        <a href="{{ route('admin.promos.create') }}" class="text-xs text-violet-400 hover:text-violet-300">Tambah promo pertama</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
