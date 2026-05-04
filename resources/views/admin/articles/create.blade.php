@extends('layouts.admin')

@section('title', 'Tulis Artikel')
@section('subtitle', 'Buat artikel baru')

@section('content')

<div class="max-w-4xl">

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
        @csrf

        <div class="grid grid-cols-3 gap-5">
            <div class="col-span-2 space-y-4">
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
                    <div>
                        <label class="block text-xs font-medium text-gray-400 mb-1.5">
                            Judul Artikel <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                               autofocus
                               placeholder="Tulis judul artikel yang menarik..."
                               class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                                      focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                                      @error('title') border-red-500 @enderror">
                        @error('title') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
                    <label class="block text-xs font-medium text-gray-400 mb-1.5">
                        Sinopsis <span class="text-red-400">*</span>
                        <span class="text-gray-600 font-normal ml-1">— maks 500 karakter, tampil di daftar artikel</span>
                    </label>
                    <textarea name="sinopsis" rows="3" required
                              maxlength="500"
                              placeholder="Ringkasan singkat artikel..."
                              class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                                     focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors resize-none
                                     @error('sinopsis') border-red-500 @enderror">{{ old('sinopsis') }}</textarea>
                    @error('sinopsis') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
                    <label class="block text-xs font-medium text-gray-400 mb-2">
                        Isi Artikel <span class="text-red-400">*</span>
                    </label>
                    <textarea name="content" id="content">{{ old('content') }}</textarea>
                    @error('content') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

            </div>

            <div class="space-y-4">
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
                    <h3 class="text-sm font-semibold text-white mb-4">Publikasi</h3>

                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-400 mb-1.5">Status</label>
                        <select name="status"
                                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2.5 text-sm text-white
                                       focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
                            <option value="draft"     {{ old('status', 'draft') === 'draft'     ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>

                    <button type="submit"
                            class="w-full bg-violet-600 hover:bg-violet-500 text-white text-sm font-medium py-2.5 rounded-lg transition-colors mb-2">
                        Simpan Artikel
                    </button>
                    <a href="{{ route('admin.articles.index') }}"
                       class="block w-full text-center text-xs text-gray-500 hover:text-gray-300 py-2 transition-colors">
                        Batal
                    </a>
                </div>

                <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
                    <h3 class="text-sm font-semibold text-white mb-1">Thumbnail</h3>
                    <p class="text-xs text-gray-600 mb-4">JPG/PNG/WEBP, maks 4MB. Rasio ideal 16:9.</p>

                    <div id="uploadArea"
                         class="border-2 border-dashed border-gray-700 rounded-xl flex flex-col items-center justify-center gap-2 py-8 cursor-pointer
                                hover:border-violet-500/50 hover:bg-violet-500/5 transition-colors">
                        <svg class="w-7 h-7 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                        </svg>
                        <p class="text-xs text-gray-500">Klik untuk pilih gambar</p>
                    </div>

                    <input type="file" id="thumbnailInput" name="thumbnail" accept="image/*" class="hidden">

                    <div id="thumbnailPreview" class="hidden mt-3">
                        <div class="relative rounded-lg overflow-hidden border border-gray-700">
                            <img id="previewImg" src="" alt="Preview" class="w-full object-cover max-h-40">
                            <button type="button" id="clearThumbBtn"
                                    class="absolute top-2 right-2 w-6 h-6 bg-gray-900/80 hover:bg-gray-900 text-gray-300 hover:text-white rounded-full flex items-center justify-center transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    @error('thumbnail') <p class="mt-2 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

            </div>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/35.2.0/classic/ckeditor.js"></script>

@push('scripts')
<script>
ClassicEditor
    .create(document.querySelector('#content'), {
        toolbar: {
            items: [
                'heading', '|',
                'bold', 'italic', 'underline', 'link', '|',
                'bulletedList', 'numberedList', 'blockQuote', '|',
                'imageUpload', '|',
                'undo', 'redo'
            ]
        },
        ckfinder: {
            uploadUrl: '{{ route('admin.articles.uploadImage') }}?_token={{ csrf_token() }}'
        }
    })
    .catch(err => console.error('CKEditor error:', err));

const uploadArea     = document.getElementById('uploadArea');
const thumbnailInput = document.getElementById('thumbnailInput');
const preview        = document.getElementById('thumbnailPreview');
const previewImg     = document.getElementById('previewImg');
const clearBtn       = document.getElementById('clearThumbBtn');

uploadArea.addEventListener('click', () => thumbnailInput.click());

thumbnailInput.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        previewImg.src = e.target.result;
        uploadArea.classList.add('hidden');
        preview.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
});

clearBtn.addEventListener('click', () => {
    thumbnailInput.value = '';
    previewImg.src = '';
    preview.classList.add('hidden');
    uploadArea.classList.remove('hidden');
});
</script>
@endpush

@endsection
