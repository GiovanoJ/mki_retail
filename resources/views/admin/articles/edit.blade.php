@extends('layouts.admin')

@section('title', 'Edit Artikel')
@section('subtitle', Str::limit($article->title, 50))

@section('content')

<nav class="flex items-center gap-2 mb-5 text-xs text-gray-500">
    <a href="{{ route('admin.articles.index') }}" class="hover:text-gray-300 transition-colors">Artikel</a>
    <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
    </svg>
    <span>Edit</span>
</nav>

<div class="max-w-4xl">

    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="grid grid-cols-3 gap-5">
            <div class="col-span-2 space-y-4">
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
                    <label class="block text-xs font-medium text-gray-400 mb-1.5">
                        Judul Artikel <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title', $article->title) }}" required
                           placeholder="Tulis judul artikel yang menarik..."
                           class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                                  focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                                  @error('title') border-red-500 @enderror">
                    @error('title') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
                    <label class="block text-xs font-medium text-gray-400 mb-1.5">
                        Sinopsis <span class="text-red-400">*</span>
                        <span class="text-gray-600 font-normal ml-1">— maks 500 karakter</span>
                    </label>
                    <textarea name="sinopsis" rows="3" required maxlength="500"
                              placeholder="Ringkasan singkat artikel..."
                              class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                                     focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors resize-none
                                     @error('sinopsis') border-red-500 @enderror">{{ old('sinopsis', $article->sinopsis) }}</textarea>
                    @error('sinopsis') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
                    <label class="block text-xs font-medium text-gray-400 mb-2">
                        Isi Artikel <span class="text-red-400">*</span>
                    </label>
                    <textarea name="content" id="content">{{ old('content', $article->content) }}</textarea>
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
                            <option value="draft"     {{ old('status', $article->status) === 'draft'     ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $article->status) === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>

                    <button type="submit"
                            class="w-full bg-violet-600 hover:bg-violet-500 text-white text-sm font-medium py-2.5 rounded-lg transition-colors mb-2">
                        Simpan Perubahan
                    </button>

                    @if($article->status === 'published')
                        <a href="{{ route('articles.show', $article->slug) }}" target="_blank"
                           class="block w-full text-center text-xs text-violet-400 hover:text-violet-300 py-1.5 transition-colors">
                            Lihat di website →
                        </a>
                    @endif

                    <div class="border-t border-gray-800 mt-3 pt-3">
                        <button type="button" id="deleteArticleBtn"
                                class="w-full flex items-center justify-center gap-1.5 text-xs text-red-400 hover:text-red-300
                                       border border-red-500/30 hover:border-red-500/60 bg-red-500/5 hover:bg-red-500/10
                                       px-3 py-2 rounded-lg transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus Artikel
                        </button>
                    </div>
                </div>

                <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
                    <h3 class="text-sm font-semibold text-white mb-1">Thumbnail</h3>
                    <p class="text-xs text-gray-600 mb-4">JPG/PNG/WEBP, maks 4MB.</p>

                    @if($article->thumbnail)
                        <div id="currentThumb" class="mb-3 rounded-lg overflow-hidden border border-gray-700">
                            <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                 class="w-full object-cover max-h-40" alt="{{ $article->title }}">
                        </div>
                        <button type="button" id="changeThumbBtn"
                                class="w-full text-xs text-gray-400 hover:text-white border border-gray-700 hover:border-gray-600 py-2 rounded-lg transition-colors mb-3">
                            Ganti Thumbnail
                        </button>
                    @endif

                    <div id="uploadArea" class="{{ $article->thumbnail ? 'hidden' : '' }} border-2 border-dashed border-gray-700 rounded-xl flex flex-col items-center justify-center gap-2 py-8 cursor-pointer
                            hover:border-violet-500/50 hover:bg-violet-500/5 transition-colors">
                        <svg class="w-7 h-7 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                        </svg>
                        <p class="text-xs text-gray-500">Klik untuk pilih gambar</p>
                    </div>

                    <input type="file" id="thumbnailInput" name="thumbnail" accept="image/*" class="hidden">

                    <div id="thumbnailPreview" class="hidden mt-3">
                        <div class="relative rounded-lg overflow-hidden border border-violet-500/40">
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

<div id="deleteModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4" style="background:rgba(0,0,0,0.6)">
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 w-full max-w-sm shadow-2xl">
        <div class="flex items-start gap-4 mb-5">
            <div class="w-10 h-10 rounded-full bg-red-500/15 border border-red-500/30 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white mb-1">Hapus artikel ini?</h3>
                <p class="text-xs text-gray-400 leading-relaxed">
                    <span class="text-white font-medium">{{ $article->title }}</span> akan dihapus permanen.
                </p>
            </div>
        </div>
        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST">
            @csrf @method('DELETE')
            <div class="flex gap-2">
                <button type="button" id="cancelDeleteBtn"
                        class="flex-1 text-sm text-gray-400 hover:text-white border border-gray-700 py-2 rounded-lg transition-colors">Batal</button>
                <button type="submit"
                        class="flex-1 text-sm font-medium bg-red-600 hover:bg-red-500 text-white py-2 rounded-lg transition-colors">Ya, Hapus</button>
            </div>
        </form>
    </div>
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

const modal     = document.getElementById('deleteModal');
const cancelBtn = document.getElementById('cancelDeleteBtn');
document.getElementById('deleteArticleBtn').addEventListener('click', () => modal.classList.remove('hidden'));
cancelBtn.addEventListener('click', () => modal.classList.add('hidden'));
modal.addEventListener('click', e => { if (e.target === modal) modal.classList.add('hidden'); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') modal.classList.add('hidden'); });

const uploadArea     = document.getElementById('uploadArea');
const thumbnailInput = document.getElementById('thumbnailInput');
const preview        = document.getElementById('thumbnailPreview');
const previewImg     = document.getElementById('previewImg');
const clearBtn       = document.getElementById('clearThumbBtn');
const changeBtn      = document.getElementById('changeThumbBtn');
const currentThumb   = document.getElementById('currentThumb');

uploadArea.addEventListener('click', () => thumbnailInput.click());
changeBtn?.addEventListener('click', () => thumbnailInput.click());

thumbnailInput.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        previewImg.src = e.target.result;
        uploadArea.classList.add('hidden');
        currentThumb?.classList.add('hidden');
        changeBtn?.classList.add('hidden');
        preview.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
});

clearBtn?.addEventListener('click', () => {
    thumbnailInput.value = '';
    previewImg.src = '';
    preview.classList.add('hidden');
    @if($article->thumbnail)
        currentThumb?.classList.remove('hidden');
        changeBtn?.classList.remove('hidden');
    @else
        uploadArea.classList.remove('hidden');
    @endif
});
</script>
@endpush

@endsection
