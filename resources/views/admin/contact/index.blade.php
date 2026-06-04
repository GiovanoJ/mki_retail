@extends('layouts.admin')

@section('title', 'Pesan Masuk')
@section('subtitle', 'Pesan dari form kontak website')

@section('content')

    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-3">
            <span class="text-xs text-gray-500 bg-gray-800 border border-gray-700 px-3 py-1.5 rounded-lg">
                {{ $messages->total() }} pesan
            </span>
            @if($unreadCount > 0)
                <span class="text-xs bg-violet-600 text-white px-3 py-1.5 rounded-lg">
                    {{ $unreadCount }} belum dibaca
                </span>
            @endif
        </div>

        @if($unreadCount > 0)
            <form action="{{ route('admin.contact.markAllRead') }}" method="POST">
                @csrf
                <button type="submit"
                        class="text-xs text-gray-400 hover:text-white border border-gray-700 hover:border-gray-500 px-3 py-1.5 rounded-lg transition-colors">
                    Tandai Semua Dibaca
                </button>
            </form>
        @endif
    </div>

    @if($messages->isEmpty())
        <div class="bg-gray-900 border border-gray-800 rounded-xl py-20 flex flex-col items-center gap-3">
            <svg class="w-10 h-10 text-gray-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
            </svg>
            <p class="text-sm text-gray-500">Belum ada pesan masuk.</p>
        </div>
    @else
        <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-800">
                        <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Pengirim</th>
                        <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Keperluan</th>
                        <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Pesan</th>
                        <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Waktu</th>
                        <th class="text-left text-xs font-medium text-gray-500 px-4 py-3">Status</th>
                        <th class="text-right text-xs font-medium text-gray-500 px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($messages as $message)
                        <tr class="hover:bg-gray-800/40 transition-colors {{ !$message->is_read ? 'bg-violet-500/5' : '' }}">

                            {{-- Pengirim --}}
                            <td class="px-4 py-3">
                                <p class="text-gray-200 font-medium text-sm {{ !$message->is_read ? 'text-white' : '' }}">
                                    {{ $message->name }}
                                </p>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $message->email }}</p>
                                @if($message->phone)
                                    <p class="text-xs text-gray-600 mt-0.5">{{ $message->phone }}</p>
                                @endif
                            </td>

                            {{-- Keperluan --}}
                            <td class="px-4 py-3">
                                <span class="text-xs text-gray-400">
                                    {{ $message->subject ?? '—' }}
                                </span>
                            </td>

                            {{-- Preview pesan --}}
                            <td class="px-4 py-3">
                                <p class="text-xs text-gray-500 max-w-xs truncate">
                                    {{ Str::limit($message->message, 80) }}
                                </p>
                            </td>

                            {{-- Waktu --}}
                            <td class="px-4 py-3 text-xs text-gray-500 whitespace-nowrap">
                                {{ $message->created_at->format('d M Y') }}<br>
                                {{ $message->created_at->format('H:i') }} WIB
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-3">
                                @if(!$message->is_read)
                                    <span class="inline-flex items-center gap-1 text-xs bg-violet-500/15 text-violet-400 border border-violet-500/30 px-2.5 py-1 rounded-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-violet-400"></span>
                                        Baru
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-xs bg-gray-700/50 text-gray-500 border border-gray-700 px-2.5 py-1 rounded-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                                        Dibaca
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.contact.show', $message) }}"
                                       class="text-xs text-gray-400 hover:text-white bg-gray-800 hover:bg-gray-700 border border-gray-700 px-3 py-1.5 rounded-lg transition-colors">
                                        Buka
                                    </a>
                                    <button type="button"
                                            class="delete-btn text-xs text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 border border-red-500/30 px-3 py-1.5 rounded-lg transition-colors"
                                            data-name="{{ $message->name }}"
                                            data-action="{{ route('admin.contact.destroy', $message) }}">
                                        Hapus
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="mt-4">
                {{ $messages->links() }}
            </div>
        @endif
    @endif

    {{-- Delete Modal --}}
    <div id="deleteModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4" style="background:rgba(0,0,0,0.6)">
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 w-full max-w-sm shadow-2xl">
            <div class="flex items-start gap-4 mb-5">
                <div class="w-10 h-10 rounded-full bg-red-500/15 border border-red-500/30 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-white mb-1">Hapus pesan ini?</h3>
                    <p class="text-xs text-gray-400">
                        Pesan dari <span id="modalName" class="text-white"></span> akan dihapus permanen.
                    </p>
                </div>
            </div>
            <form id="deleteForm" method="POST">
                @csrf @method('DELETE')
                <div class="flex gap-2">
                    <button type="button" id="cancelBtn"
                            class="flex-1 text-sm text-gray-400 hover:text-white border border-gray-700 py-2 rounded-lg transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 text-sm font-medium bg-red-600 hover:bg-red-500 text-white py-2 rounded-lg transition-colors">
                        Hapus
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
const modalName  = document.getElementById('modalName');

document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        modalName.textContent = btn.dataset.name;
        deleteForm.action     = btn.dataset.action;
        modal.classList.remove('hidden');
    });
});

document.getElementById('cancelBtn').addEventListener('click', () => modal.classList.add('hidden'));
modal.addEventListener('click', e => { if (e.target === modal) modal.classList.add('hidden'); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') modal.classList.add('hidden'); });
</script>
@endpush
