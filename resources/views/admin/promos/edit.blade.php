@extends('layouts.admin')
@section('title', 'Edit Promo')
@section('subtitle', $promo->title ?: 'Promo #' . $promo->id)

@section('content')
<div class="max-w-xl">
    <form action="{{ route('admin.promos.update', $promo) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-5 space-y-5">

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Gambar Promo</label>
                <div id="currentImg" class="rounded-xl overflow-hidden border border-gray-700 mb-3">
                    <img src="{{ asset('storage/' . $promo->image_path) }}" class="w-full object-cover max-h-48" alt="">
                </div>
                <button type="button" id="changeBtn"
                        class="text-xs text-gray-400 hover:text-white border border-gray-700 px-3 py-1.5 rounded-lg transition-colors">
                    Ganti Gambar
                </button>
                <input type="file" id="imageInput" name="image" accept="image/*" class="hidden">
                <div id="preview" class="hidden mt-3 rounded-xl overflow-hidden border border-violet-500/40">
                    <img id="previewImg" class="w-full object-cover max-h-48" alt="preview">
                </div>
                @error('image') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Judul</label>
                <input type="text" name="title" value="{{ old('title', $promo->title) }}"
                       placeholder="Contoh: Promo Akhir Tahun"
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $promo->subtitle) }}"
                       placeholder="Contoh: Diskon hingga 30%"
                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Urutan Tampil</label>
                <input type="number" name="order" value="{{ old('order', $promo->order) }}" min="0"
                       class="w-32 bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white
                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-400 mb-1.5">Status</label>
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $promo->is_active) ? 'checked' : '' }}
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
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('changeBtn').addEventListener('click', () => document.getElementById('imageInput').click());
document.getElementById('imageInput').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('previewImg').src = e.target.result;
        document.getElementById('preview').classList.remove('hidden');
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
@endsection
