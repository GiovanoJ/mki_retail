@extends('layouts.admin')

@section('title', 'Kategori Produk')
@section('subtitle', 'Kelola kategori yang bisa dipilih untuk produk')

@section('content')

    <div class="flex items-center justify-between mb-5">
        <span class="text-xs text-gray-500 bg-gray-800 border border-gray-700 px-3 py-1.5 rounded-lg">
            {{ $categories->count() }} kategori
        </span>
        <a href="{{ route('admin.product-categories.create') }}"
           class="flex items-center gap-2 bg-violet-600 hover:bg-violet-500 text-white text-sm px-4 py-2 rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Kategori
        </a>
    </div>

    @if($categories->isEmpty())
        <div class="bg-gray-900 border border-gray-800 rounded-xl py-20 flex flex-col items-center gap-3">
            <svg class="w-10 h-10 text-gray-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
            </svg>
            <p class="text-sm text-gray-500">Belum ada kategori. Tambahkan kategori pertama.</p>
            <a href="{{ route('admin.product-categories.create') }}"
               class="text-xs text-violet-400 hover:text-violet-300 transition-colors">Buat kategori pertama</a>
        </div>
    @else
        <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-800">
                        <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Nama</th>
                        <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Slug</th>
                        <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Tampil di Tab</th>
                        <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Urutan</th>
                        <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Produk</th>
                        <th class="text-right text-xs font-medium text-gray-500 px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($categories as $category)
                        <tr class="hover:bg-gray-800/40 transition-colors">

                            <td class="px-4 py-3">
                                <p class="text-gray-200 font-medium">{{ $category->label }}</p>
                            </td>

                            <td class="px-4 py-3">
                                <span class="font-mono text-xs text-violet-300 bg-violet-500/10 border border-violet-500/20 px-2 py-1 rounded">
                                    {{ $category->slug }}
                                </span>
                            </td>

                            <td class="px-4 py-3">
                                @if($category->show_in_tab)
                                    <span class="inline-flex items-center gap-1 text-xs bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 px-2.5 py-1 rounded-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        Tampil
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-xs bg-gray-700/50 text-gray-400 border border-gray-700 px-2.5 py-1 rounded-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                                        Tersembunyi
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-gray-400 font-mono text-xs">{{ $category->order }}</td>

                            <td class="px-4 py-3">
                                @php $count = $category->products_count ?? $category->productsCount(); @endphp
                                <span class="text-xs {{ $count > 0 ? 'text-gray-300' : 'text-gray-600' }}">
                                    {{ $count }} produk
                                </span>
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.product-categories.edit', $category) }}"
                                       class="text-xs text-gray-400 hover:text-white bg-gray-800 hover:bg-gray-700 border border-gray-700 px-3 py-1.5 rounded-lg transition-colors">
                                        Edit
                                    </a>
                                    <button type="button"
                                            class="delete-cat-btn text-xs text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 border border-red-500/30 px-3 py-1.5 rounded-lg transition-colors"
                                            data-label="{{ $category->label }}"
                                            data-count="{{ $count }}"
                                            data-action="{{ route('admin.product-categories.destroy', $category) }}">
                                        Hapus
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Delete modal --}}
    <div id="deleteCatModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4" style="background:rgba(0,0,0,0.6)">
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 w-full max-w-sm shadow-2xl">
            <div class="flex items-start gap-4 mb-5">
                <div class="w-10 h-10 rounded-full bg-red-500/15 border border-red-500/30 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-white mb-1">Hapus kategori ini?</h3>
                    <p class="text-xs text-gray-400 leading-relaxed" id="deleteCatDesc">
                        Kategori <span id="modalCatLabel" class="text-white font-medium"></span> akan dihapus permanen.
                    </p>
                </div>
            </div>
            <form id="deleteCatForm" method="POST">
                @csrf @method('DELETE')
                <div class="flex gap-2">
                    <button type="button" id="cancelDeleteCatBtn"
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
const catModal     = document.getElementById('deleteCatModal');
const catForm      = document.getElementById('deleteCatForm');
const catLabelEl   = document.getElementById('modalCatLabel');
const catDescEl    = document.getElementById('deleteCatDesc');

document.querySelectorAll('.delete-cat-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const label = btn.dataset.label;
        const count = parseInt(btn.dataset.count, 10) || 0;

        catLabelEl.textContent = label;
        catForm.action         = btn.dataset.action;

        if (count > 0) {
            catDescEl.innerHTML = `Kategori <span class="text-white font-medium">${label}</span> masih dipakai oleh <span class="text-amber-400 font-medium">${count} produk</span>. Anda harus menghapus atau mengubah kategori produk tersebut terlebih dahulu sebelum kategori ini bisa dihapus.`;
        } else {
            catDescEl.innerHTML = `Kategori <span class="text-white font-medium">${label}</span> akan dihapus permanen.`;
        }

        catModal.classList.remove('hidden');
    });
});

document.getElementById('cancelDeleteCatBtn').addEventListener('click', () => catModal.classList.add('hidden'));
catModal.addEventListener('click', e => { if (e.target === catModal) catModal.classList.add('hidden'); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') catModal.classList.add('hidden'); });
</script>
@endpush
