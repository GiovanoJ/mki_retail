@extends('layouts.admin')

@section('title', 'Artikel')
@section('subtitle', 'Kelola konten artikel website')

@section('content')

    <div class="flex items-center justify-between mb-5">
        <span class="text-xs text-gray-500 bg-gray-800 border border-gray-700 px-3 py-1.5 rounded-lg">
            {{ $articles->count() }} artikel
        </span>
        <a href="{{ route('admin.articles.create') }}"
           class="flex items-center gap-2 bg-violet-600 hover:bg-violet-500 text-white text-sm px-4 py-2 rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tulis Artikel
        </a>
    </div>

    @if($articles->isEmpty())
        <div class="bg-gray-900 border border-gray-800 rounded-xl py-20 flex flex-col items-center gap-3">
            <svg class="w-10 h-10 text-gray-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <p class="text-sm text-gray-500">Belum ada artikel. Mulai tulis sekarang.</p>
            <a href="{{ route('admin.articles.create') }}"
               class="text-xs text-violet-400 hover:text-violet-300 transition-colors">Buat artikel pertama</a>
        </div>
    @else
        <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-800">
                        <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Artikel</th>
                        <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Status</th>
                        <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Tanggal</th>
                        <th class="text-right text-xs font-medium text-gray-500 px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($articles as $article)
                        <tr class="hover:bg-gray-800/40 transition-colors">

                            {{-- Thumbnail + Title --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if($article->thumbnail)
                                        <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                             class="w-14 h-10 object-cover rounded-lg border border-gray-700 shrink-0"
                                             alt="{{ $article->title }}">
                                    @else
                                        <div class="w-14 h-10 rounded-lg border border-gray-700 bg-gray-800 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="text-gray-200 font-medium leading-tight truncate max-w-xs">{{ $article->title }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5 truncate max-w-xs">{{ $article->sinopsis }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-3">
                                @if($article->status === 'published')
                                    <span class="inline-flex items-center gap-1 text-xs bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 px-2.5 py-1 rounded-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-xs bg-amber-500/15 text-amber-400 border border-amber-500/30 px-2.5 py-1 rounded-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                        Draft
                                    </span>
                                @endif
                            </td>

                            {{-- Date --}}
                            <td class="px-4 py-3 text-xs text-gray-500">
                                {{ $article->created_at->format('d M Y') }}
                            </td>

                            {{-- Actions --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    @if($article->status === 'published')
                                        <a href="{{ route('articles.show', $article->slug) }}" target="_blank"
                                           class="text-xs text-gray-400 hover:text-white bg-gray-800 hover:bg-gray-700 border border-gray-700 px-3 py-1.5 rounded-lg transition-colors">
                                            Lihat
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.articles.edit', $article) }}"
                                       class="text-xs text-gray-400 hover:text-white bg-gray-800 hover:bg-gray-700 border border-gray-700 px-3 py-1.5 rounded-lg transition-colors">
                                        Edit
                                    </a>
                                    <button type="button"
                                            class="delete-btn text-xs text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 border border-red-500/30 px-3 py-1.5 rounded-lg transition-colors"
                                            data-title="{{ $article->title }}"
                                            data-action="{{ route('admin.articles.destroy', $article) }}">
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

    <div id="deleteModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4" style="background:rgba(0,0,0,0.6)">
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 w-full max-w-sm shadow-2xl">
            <div class="flex items-start gap-4 mb-5">
                <div class="w-10 h-10 rounded-full bg-red-500/15 border border-red-500/30 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-white mb-1">Hapus artikel ini?</h3>
                    <p class="text-xs text-gray-400 leading-relaxed">
                        "<span id="modalArticleTitle" class="text-white"></span>" akan dihapus.
                        Tindakan ini tidak bisa dibatalkan.
                    </p>
                </div>
            </div>
            <form id="deleteForm" method="POST">
                @csrf @method('DELETE')
                <div class="flex gap-2">
                    <button type="button" id="cancelDeleteBtn"
                            class="flex-1 text-sm text-gray-400 hover:text-white border border-gray-700 py-2 rounded-lg transition-colors">
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
const modal      = document.getElementById('deleteModal');
const deleteForm = document.getElementById('deleteForm');
const titleEl    = document.getElementById('modalArticleTitle');

document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        titleEl.textContent  = btn.dataset.title;
        deleteForm.action    = btn.dataset.action;
        modal.classList.remove('hidden');
    });
});

document.getElementById('cancelDeleteBtn').addEventListener('click', () => modal.classList.add('hidden'));
modal.addEventListener('click', e => { if (e.target === modal) modal.classList.add('hidden'); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') modal.classList.add('hidden'); });
</script>
@endpush
