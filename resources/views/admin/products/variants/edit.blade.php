@extends('layouts.admin')

@section('title', 'Edit Varian')
@section('subtitle', $product->name . ' / ' . $variant->sku)

@section('content')

    <nav class="flex items-center gap-2 mb-5 text-xs text-gray-500">
        <a href="{{ route('admin.products.index') }}" class="hover:text-gray-300 transition-colors">Produk</a>
        <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('admin.products.variants.index', $product) }}" class="hover:text-gray-300 transition-colors truncate max-w-[140px]">{{ $product->name }}</a>
        <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="font-mono text-violet-400">{{ $variant->sku }}</span>
    </nav>

    <form action="{{ route('admin.products.variants.update', [$product, $variant]) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="grid grid-cols-3 gap-5">

            {{-- ── Left column ── --}}
            <div class="col-span-2 space-y-4">

                {{-- Identitas --}}
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
                    <h3 class="text-sm font-semibold text-white mb-4">Identitas Varian</h3>
                    <div class="space-y-4">

                        {{-- SKU --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-400 mb-1.5">SKU / Kode Produk <span class="text-red-400">*</span></label>
                            <input type="text" name="sku" value="{{ old('sku', $variant->sku) }}" required
                                   class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white font-mono
                                          focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                                          @error('sku') border-red-500 @enderror">
                            @error('sku') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-3 gap-4">

                            {{-- Warna --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-400 mb-1.5">Warna Varian</label>
                                <div class="flex items-center gap-2">
                                    <input type="text" id="variantColor" name="color"
                                           value="{{ old('color', $variant->color) }}"
                                           placeholder="#ffffff" maxlength="7"
                                           class="flex-1 bg-gray-800 border border-gray-700 rounded-lg px-3 py-2.5 text-sm text-white font-mono placeholder-gray-600
                                                  focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                                                  @error('color') border-red-500 @enderror">
                                    <div id="mainColorSwatch"
                                         class="w-8 h-8 rounded-full border-2 border-gray-600 shrink-0 transition-colors"
                                         style="background:{{ old('color', $variant->color) ?: '#374151' }}">
                                    </div>
                                </div>
                                <p class="text-xs text-gray-600 mt-1">Klik gambar di kanan untuk pick warna</p>
                                @error('color') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                            </div>

                            {{-- Harga Override --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-400 mb-1.5">Harga Override (Rp)</label>
                                <input type="number" name="price_override"
                                       value="{{ old('price_override', $variant->price_override) }}"
                                       min="0" step="100" placeholder="Kosong = ikut induk"
                                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-gray-600
                                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
                                <p class="text-xs text-gray-600 mt-1">Induk: {{ $product->formattedPrice() }}</p>
                            </div>

                            {{-- Stok --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-400 mb-1.5">Stok <span class="text-red-400">*</span></label>
                                <input type="number" name="stock"
                                       value="{{ old('stock', $variant->stock) }}" min="0" required
                                       class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3.5 py-2.5 text-sm text-white
                                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors
                                              @error('stock') border-red-500 @enderror">
                                @error('stock') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                            </div>

                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-400 mb-1.5">Status</label>
                            <label class="flex items-center gap-2.5 cursor-pointer w-fit">
                                <div class="relative">
                                    <input type="checkbox" name="is_active" value="1"
                                           {{ old('is_active', $variant->is_active) ? 'checked' : '' }}
                                           class="sr-only peer">
                                    <div class="w-10 h-6 bg-gray-700 peer-checked:bg-violet-600 rounded-full transition-colors"></div>
                                    <div class="absolute top-1 left-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4 pointer-events-none"></div>
                                </div>
                                <span class="text-sm text-gray-300">Aktif</span>
                            </label>
                        </div>

                    </div>
                </div>

                {{-- Atribut --}}
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-sm font-semibold text-white">Atribut Varian</h3>
                            <p class="text-xs text-gray-600 mt-0.5">Label bebas — Ukuran, Bahan, dll.</p>
                        </div>
                        <button type="button" id="addAttrBtn"
                                class="flex items-center gap-1.5 text-xs text-violet-400 hover:text-violet-300 border border-violet-500/30 px-3 py-1.5 rounded-lg transition-colors">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Tambah
                        </button>
                    </div>

                    <div class="flex items-center gap-2 mb-2 px-1">
                        <p class="text-xs text-gray-600 w-[30%]">Label</p>
                        <p class="text-xs text-gray-600 flex-1">Nilai</p>
                        <div class="w-7"></div>
                    </div>

                    <div id="attrList" class="space-y-2">
                        @php $attrs = old('attributes', $variant->attributes ?? []); @endphp
                        @foreach($attrs as $i => $attr)
                            <div class="attr-row flex items-center gap-2" data-idx="{{ $i }}">
                                <input type="text" name="attributes[{{ $i }}][key]"
                                       value="{{ $attr['key'] ?? '' }}" placeholder="Label"
                                       class="attr-key w-[30%] bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white
                                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
                                <input type="text" name="attributes[{{ $i }}][value]"
                                       value="{{ $attr['value'] ?? '' }}" placeholder="Nilai"
                                       class="attr-val flex-1 bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white
                                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
                                <button type="button" class="remove-attr w-7 h-7 flex items-center justify-center text-gray-600 hover:text-red-400 shrink-0 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Spesifikasi --}}
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-sm font-semibold text-white">Spesifikasi Teknis</h3>
                            <p class="text-xs text-gray-600 mt-0.5">Opsional — tampil sebagai tabel di halaman produk</p>
                        </div>
                        <button type="button" id="addSpecBtn"
                                class="flex items-center gap-1.5 text-xs text-violet-400 hover:text-violet-300 border border-violet-500/30 px-3 py-1.5 rounded-lg transition-colors">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Tambah
                        </button>
                    </div>
                    <div id="specList" class="space-y-2">
                        @php $specs = old('specs', $variant->specifications ?? []); @endphp
                        @foreach($specs as $i => $spec)
                            <div class="spec-row flex items-center gap-2">
                                <input type="text" name="specs[{{ $i }}][key]"
                                       value="{{ $spec['key'] ?? '' }}" placeholder="Contoh: Berat"
                                       class="w-[30%] bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600
                                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
                                <span class="text-gray-600 text-sm">:</span>
                                <input type="text" name="specs[{{ $i }}][value]"
                                       value="{{ $spec['value'] ?? '' }}" placeholder="Contoh: 250gr"
                                       class="flex-1 bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600
                                              focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
                                <button type="button" onclick="this.closest('.spec-row').remove()"
                                        class="w-7 h-7 flex items-center justify-center text-gray-600 hover:text-red-400 shrink-0 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            {{-- ── Right column ── --}}
            <div class="space-y-4">

                <div class="bg-gray-900 border border-gray-800 rounded-xl p-5">
                    <h3 class="text-sm font-semibold text-white mb-1">Gambar Varian</h3>
                    <p class="text-xs text-gray-600 mb-4">Upload lalu klik gambar untuk pick warna varian.</p>

                    {{-- Preview gambar existing --}}
                    @if($variant->image_path)
                        <div id="currentImg" class="mb-3 rounded-lg overflow-hidden border border-gray-700">
                            <img src="{{ asset('storage/' . $variant->image_path) }}"
                                 class="w-full object-cover" alt="{{ $variant->sku }}">
                        </div>
                        <button type="button" id="changeImgBtn"
                                class="w-full text-xs text-gray-400 hover:text-white border border-gray-700 hover:border-gray-600 py-2 rounded-lg transition-colors mb-3">
                            Ganti Foto
                        </button>
                    @endif

                    <div id="uploadArea"
                         class="{{ $variant->image_path ? 'hidden' : '' }} border-2 border-dashed border-gray-700 rounded-xl flex flex-col items-center justify-center gap-2 py-10 cursor-pointer
                                hover:border-violet-500/50 hover:bg-violet-500/5 transition-colors">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                        </svg>
                        <p class="text-xs text-gray-500">Klik untuk pilih gambar</p>
                        <p class="text-xs text-gray-600">PNG, JPG, WEBP — maks 5MB</p>
                    </div>

                    <input type="file" id="imageInput" name="image" accept="image/*" class="hidden">
                    
                    @error('image')
                        <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror

                    {{-- Canvas eyedropper --}}
                    <div id="canvasWrapper" class="hidden mt-3">
                        <div class="relative rounded-lg overflow-hidden border border-gray-700 bg-gray-950">
                            <canvas id="imageCanvas" class="w-full block cursor-crosshair"></canvas>
                            <div id="colorBubble"
                                 class="hidden absolute pointer-events-none"
                                 style="transform:translate(-50%,-110%); width:52px; height:52px;">
                                <div id="bubbleSwatch"
                                     class="w-10 h-10 rounded-full border-2 border-white mx-auto block"
                                     style="margin-top:4px"></div>
                                <p id="bubbleHex"
                                   class="text-center font-mono block"
                                   style="font-size:9px;color:#fff;text-shadow:0 1px 3px #000;margin-top:2px;line-height:1"></p>
                            </div>
                        </div>
                        <div class="mt-2 flex items-center justify-between">
                            <p class="text-xs text-gray-500">
                                Klik gambar → warna masuk ke field
                                <span class="text-violet-400 font-mono">Warna Varian</span>
                            </p>
                            <button type="button" id="clearImgBtn"
                                    class="text-xs text-gray-600 hover:text-red-400 transition-colors">
                                Hapus foto
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-900 border border-gray-800 rounded-xl p-4">
                    <button type="submit"
                            class="w-full bg-violet-600 hover:bg-violet-500 text-white text-sm font-medium py-2.5 rounded-lg transition-colors mb-2">
                        Update Varian
                    </button>
                    <a href="{{ route('admin.products.variants.index', $product) }}"
                       class="block w-full text-center text-xs text-gray-500 hover:text-gray-300 py-2 transition-colors">
                        Batal
                    </a>
                </div>

            </div>
        </div>
    </form>

@endsection

@push('scripts')
<script>
let attrIdx = {{ count(old('attributes', $variant->attributes ?? [])) }};
let specIdx = {{ count(old('specs', $variant->specifications ?? [])) }};

document.getElementById('uploadArea').addEventListener('click', () => {
    document.getElementById('imageInput').click();
});

@if($variant->image_path)
document.getElementById('changeImgBtn').addEventListener('click', () => {
    document.getElementById('imageInput').click();
});
@endif

function attachAttrEvents(row) {
    row.querySelector('.remove-attr').addEventListener('click', () => row.remove());
}
document.querySelectorAll('.attr-row').forEach(row => attachAttrEvents(row));

function makeAttrRow(i) {
    const div = document.createElement('div');
    div.className = 'attr-row flex items-center gap-2';
    div.dataset.idx = i;
    div.innerHTML = `
        <input type="text" name="attributes[${i}][key]" placeholder="Label"
               class="attr-key w-[30%] bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white
                      focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
        <input type="text" name="attributes[${i}][value]" placeholder="Nilai"
               class="attr-val flex-1 bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white
                      focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
        <button type="button" class="remove-attr w-7 h-7 flex items-center justify-center text-gray-600 hover:text-red-400 shrink-0 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>`;
    return div;
}

document.getElementById('addAttrBtn').addEventListener('click', () => {
    const row = makeAttrRow(attrIdx++);
    document.getElementById('attrList').appendChild(row);
    attachAttrEvents(row);
});

function makeSpecRow(i) {
    const div = document.createElement('div');
    div.className = 'spec-row flex items-center gap-2';
    div.innerHTML = `
        <input type="text" name="specs[${i}][key]" placeholder="Contoh: Berat"
               class="w-[30%] bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600
                      focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
        <span class="text-gray-600 text-sm">:</span>
        <input type="text" name="specs[${i}][value]" placeholder="Contoh: 250gr"
               class="flex-1 bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600
                      focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
        <button type="button" onclick="this.closest('.spec-row').remove()"
                class="w-7 h-7 flex items-center justify-center text-gray-600 hover:text-red-400 shrink-0 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>`;
    return div;
}

document.getElementById('addSpecBtn').addEventListener('click', () => {
    document.getElementById('specList').appendChild(makeSpecRow(specIdx++));
});

const canvas      = document.getElementById('imageCanvas');
const ctx         = canvas.getContext('2d', { willReadFrequently: true });
const bubble      = document.getElementById('colorBubble');
const bubbleSw    = document.getElementById('bubbleSwatch');
const bubbleHx    = document.getElementById('bubbleHex');
const colorInput  = document.getElementById('variantColor');
const colorSwatch = document.getElementById('mainColorSwatch');
let currentBlob   = null;
let canvasReady   = false; // true hanya saat gambar sudah di-draw via blob (bukan URL server)

function rgbToHex(r, g, b) {
    return '#' + [r, g, b].map(v => v.toString(16).padStart(2, '0')).join('');
}

function drawBlobToCanvas(blobUrl) {
    const img = new Image();
    img.onload = () => {
        document.getElementById('uploadArea').classList.add('hidden');
        @if($variant->image_path)
        document.getElementById('currentImg')?.classList.add('hidden');
        document.getElementById('changeImgBtn')?.classList.add('hidden');
        @endif
        document.getElementById('canvasWrapper').classList.remove('hidden');

        const maxW  = canvas.parentElement.getBoundingClientRect().width || 280;
        const scale = Math.min(1, maxW / img.naturalWidth);
        canvas.width  = Math.round(img.naturalWidth  * scale);
        canvas.height = Math.round(img.naturalHeight * scale);
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        canvasReady = true;
    };
    img.src = blobUrl;
}

// Saat file dipilih → buat blob dan gambar ke canvas
document.getElementById('imageInput').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    if (currentBlob) URL.revokeObjectURL(currentBlob);
    currentBlob = URL.createObjectURL(file);
    canvasReady = false;
    drawBlobToCanvas(currentBlob);
});

// Hover preview bubble
canvas.addEventListener('mousemove', function (e) {
    if (!canvasReady) return;
    const rect   = canvas.getBoundingClientRect();
    const scaleX = canvas.width  / rect.width;
    const scaleY = canvas.height / rect.height;
    const x = Math.floor((e.clientX - rect.left) * scaleX);
    const y = Math.floor((e.clientY - rect.top)  * scaleY);
    try {
        const px  = ctx.getImageData(x, y, 1, 1).data;
        const hex = rgbToHex(px[0], px[1], px[2]);
        bubbleSw.style.background = hex;
        bubbleHx.textContent      = hex;
        bubble.style.left = (e.clientX - rect.left) + 'px';
        bubble.style.top  = (e.clientY - rect.top)  + 'px';
        bubble.classList.remove('hidden');
    } catch (err) {}
});

canvas.addEventListener('mouseleave', () => bubble.classList.add('hidden'));

// Klik → set ke field color
canvas.addEventListener('click', function (e) {
    if (!canvasReady) {
        alert('Upload gambar baru dulu untuk menggunakan eyedropper.');
        return;
    }
    const rect   = canvas.getBoundingClientRect();
    const scaleX = canvas.width  / rect.width;
    const scaleY = canvas.height / rect.height;
    const x = Math.floor((e.clientX - rect.left) * scaleX);
    const y = Math.floor((e.clientY - rect.top)  * scaleY);
    try {
        const px  = ctx.getImageData(x, y, 1, 1).data;
        const hex = rgbToHex(px[0], px[1], px[2]);
        colorInput.value             = hex;
        colorSwatch.style.background = hex;
    } catch (err) {
        alert('Tidak bisa membaca warna dari gambar ini.');
    }
});

// Hapus foto → kembali ke state semula
document.getElementById('clearImgBtn').addEventListener('click', () => {
    if (currentBlob) { URL.revokeObjectURL(currentBlob); currentBlob = null; }
    document.getElementById('imageInput').value = '';
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    canvasReady = false;
    document.getElementById('canvasWrapper').classList.add('hidden');

    @if($variant->image_path)
        document.getElementById('currentImg')?.classList.remove('hidden');
        document.getElementById('changeImgBtn')?.classList.remove('hidden');
    @else
        document.getElementById('uploadArea').classList.remove('hidden');
    @endif
});

// Sync manual typing → swatch
colorInput.addEventListener('input', function () {
    if (/^#[0-9a-fA-F]{6}$/.test(this.value.trim())) {
        colorSwatch.style.background = this.value.trim();
    }
});
</script>
@endpush
