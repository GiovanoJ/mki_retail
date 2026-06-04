@extends('layouts.admin')

@section('title', 'Detail Pesan')
@section('subtitle', 'Dari ' . $message->name)

@section('content')

<nav class="flex items-center gap-2 mb-5 text-xs text-gray-500">
    <a href="{{ route('admin.contact.index') }}" class="hover:text-gray-300 transition-colors">Pesan Masuk</a>
    <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
    </svg>
    <span>Detail Pesan</span>
</nav>

<div class="max-w-2xl">
    <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 space-y-5">

        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-xs font-medium text-gray-500 mb-1">Nama</p>
                <p class="text-sm text-white">{{ $message->name }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-500 mb-1">Email</p>
                <a href="mailto:{{ $message->email }}"
                   class="text-sm text-violet-400 hover:text-violet-300 transition-colors">
                    {{ $message->email }}
                </a>
            </div>
            @if($message->phone)
                <div>
                    <p class="text-xs font-medium text-gray-500 mb-1">Telepon</p>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}"
                       target="_blank" rel="noopener"
                       class="text-sm text-green-400 hover:text-green-300 transition-colors flex items-center gap-1">
                        {{ $message->phone }}
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </a>
                </div>
            @endif
            <div>
                <p class="text-xs font-medium text-gray-500 mb-1">Keperluan</p>
                <p class="text-sm text-white">{{ $message->subject ?? '—' }}</p>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-500 mb-1">Waktu Kirim</p>
                <p class="text-sm text-white">{{ $message->created_at->format('d M Y, H:i') }} WIB</p>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-500 mb-1">Status</p>
                @if($message->is_read)
                    <span class="inline-flex items-center gap-1 text-xs bg-gray-700/50 text-gray-400 border border-gray-700 px-2.5 py-1 rounded-md">
                        <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                        Dibaca {{ $message->read_at?->format('d M Y, H:i') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="border-t border-gray-800 pt-5">
            <p class="text-xs font-medium text-gray-500 mb-3">Isi Pesan</p>
            <div class="bg-gray-800 rounded-lg p-4">
                <p class="text-sm text-gray-200 leading-relaxed whitespace-pre-wrap">{{ $message->message }}</p>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-5 flex items-center gap-3">
            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject ?? 'Pesan dari Website' }}"
               class="flex items-center gap-2 bg-violet-600 hover:bg-violet-500 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                </svg>
                Balas via Email
            </a>

            @if($message->phone)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}?text={{ urlencode('Halo ' . $message->name . ', terima kasih telah menghubungi kami.') }}"
                   target="_blank" rel="noopener"
                   class="flex items-center gap-2 bg-green-600 hover:bg-green-500 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Balas via WhatsApp
                </a>
            @endif

            <a href="{{ route('admin.contact.index') }}"
               class="text-xs text-gray-500 hover:text-gray-300 transition-colors ml-auto">
                ← Kembali
            </a>
        </div>

    </div>
</div>

@endsection
