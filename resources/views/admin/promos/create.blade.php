@extends('layouts.admin')
@section('title', 'Tambah Promo')
@section('subtitle', 'Upload gambar baru untuk hero carousel')

@section('content')
<div class="max-w-xl">
    <form action="{{ route('admin.promos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-5 space-y-5">

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">
                    Gambar Promo <span class="text-red-400">*</span>
                    <span class="text-gray-600 font-normal ml-1">— JPG/PNG/WEBP, maks 8MB. Rasio ideal 16:5 atau 3:1.</span>
                </label>
                <div id="uploadArea"
                     class="border-2 border-dashed border-gray-700 rounded-xl flex flex-col items-center justify-center gap-2 py-10 cursor-pointer
                            hover:border-violet-500/50 hover:bg-violet-500/5 transition-colors">
                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                    </svg>
                    <p class="text-xs text-gray-500">Klik untuk pilih gambar</p>
                </div>
                <input type="file" id="imageInput" name="image" accept="image/*" class="hidden" required>
                <div id="preview" class="hidden mt-3 rounded-xl overflow-hidden border border-gray-700">
                    <img id="previewImg" class="w-full object-cover max-h-48" alt="preview">
                </div>
                @error('image') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Judul <span class="text-gray-600 font-normal">(opsional)</span></label>
                <input type="text" name="title" value="{{ old('title') }}"
                       placeholder="Contoh: Promo Akhir Tahun"
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Subtitle <span class="text-gray-600 font-normal">(opsional)</span></label>
                <input type="text" name="subtitle" value="{{ old('subtitle') }}"
                       placeholder="Contoh: Diskon hingga 30% untuk semua produk"
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Urutan Tampil</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" min="0"
                       class="w-32 bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
                <p class="text-xs text-gray-600 mt-1">Angka lebih kecil tampil lebih dulu</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Status</label>
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-10 h-6 bg-gray-700 peer-checked:bg-violet-600 rounded-full transition-colors"></div>
                        <div class="absolute top-1 left-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4 pointer-events-none"></div>
                    </div>
                    <span class="text-sm text-gray-300">Tampilkan di hero</span>
                </label>
            </div>
        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('admin.promos.index') }}" class="text-xs text-gray-500 hover:text-gray-300 transition-colors">Batal</a>
            <button type="submit"
                    class="bg-violet-600 hover:bg-violet-500 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">
                Simpan Promo
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('uploadArea').addEventListener('click', () => document.getElementById('imageInput').click());
document.getElementById('imageInput').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('previewImg').src = e.target.result;
        document.getElementById('preview').classList.remove('hidden');
        document.getElementById('uploadArea').classList.add('hidden');
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
@endsection
