@extends('layouts.app')

@section('title', $product->name)

@section('content')

<div class="pdp-wrap">

    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('products.index') }}">Produk</a>
        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span>{{ $product->name }}</span>
    </nav>

    @php
        $variants     = $product->variants;
        $firstVariant = $variants->first();

        $hasColors = $variants->filter(function ($v) {
            return $v->color || $v->colorHex();
        })->isNotEmpty();
    @endphp

    <div class="pdp-grid">

        <div>
            <div class="gallery-main">
                @php
                    $firstImage = $firstVariant?->image_path
                        ?? $variants->whereNotNull('image_path')->first()?->image_path;
                @endphp
                @if($firstImage)
                    <img id="mainImg"
                         src="{{ asset('storage/' . $firstImage) }}"
                         alt="{{ $product->name }}">
                @else
                    <div class="gallery-placeholder" id="galleryPlaceholder">
                        <svg width="64" height="64" fill="none" stroke="#1a1612" stroke-width="1" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                        </svg>
                    </div>
                @endif
            </div>

            @if($variants->whereNotNull('image_path')->count() > 1)
                <div class="thumb-row" id="thumbRow">
                    @foreach($variants->whereNotNull('image_path') as $v)
                        @php $isFirst = $v->id === ($firstVariant?->id ?? $variants->whereNotNull('image_path')->first()?->id); @endphp
                        <div class="thumb {{ $isFirst ? 'active' : '' }}"
                             data-vid="{{ $v->id }}"
                             data-img="{{ asset('storage/' . $v->image_path) }}">
                            <img src="{{ asset('storage/' . $v->image_path) }}" alt="{{ $v->label() }}" loading="lazy">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="pdp-info">

            @php
                $standardLabels = [];
                $customLabels   = [];
                foreach ($product->category ?? [] as $slug) {
                    if (isset(\App\Models\Product::CATEGORIES[$slug])) {
                        $standardLabels[] = \App\Models\Product::CATEGORIES[$slug];
                    } else {
                        $customLabels[] = ucwords(str_replace(['_','-'], ' ', $slug));
                    }
                }
            @endphp
            @if(count($standardLabels) || count($customLabels))
                <div class="pdp-cats">
                    @foreach($standardLabels as $lbl)
                        <span class="pdp-cat">{{ $lbl }}</span>
                    @endforeach
                    @foreach($customLabels as $lbl)
                        <span class="pdp-cat custom">{{ $lbl }}</span>
                    @endforeach
                </div>
            @endif

            <h1 class="pdp-name">{{ $product->name }}</h1>
            <p class="pdp-sku">SKU: <span id="currentSku">{{ $firstVariant?->sku ?? '—' }}</span></p>

            <div class="pdp-price" id="currentPrice">
                {{ $firstVariant ? $firstVariant->formattedPrice() : $product->formattedPrice() }}
            </div>

            @if($variants->count() > 0)
                <div class="color-section">
                    @if($hasColors)
                        <div class="section-label">
                            Warna
                            <span class="chosen-name" id="chosenColorName">
                                {{ $firstVariant?->label() ?? '' }}
                            </span>
                        </div>
                        <div class="palette" id="palette">
                            @foreach($variants as $v)
                                @php
                                    $hex = $v->color ?: $v->colorHex() ?: null;
                                @endphp
                                <button type="button"
                                        class="color-swatch {{ $loop->first ? 'active' : '' }}"
                                        data-vid="{{ $v->id }}"
                                        data-label="{{ $v->label() }}"
                                        title="{{ $v->label() }}">
                                    @if($hex)
                                        <span class="inner" style="background:{{ $hex }}"></span>
                                    @else
                                        <span class="inner" style="background: repeating-linear-gradient(45deg,#ccc,#ccc 3px,#eee 3px,#eee 8px)"></span>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    @else
                        <div class="section-label">
                            Varian
                            <span class="chosen-name" id="chosenColorName">{{ $firstVariant?->label() ?? '' }}</span>
                        </div>
                        <div class="palette" id="palette">
                            @foreach($variants as $v)
                                <button type="button"
                                        class="variant-btn {{ $loop->first ? 'active' : '' }}"
                                        data-vid="{{ $v->id }}"
                                        data-label="{{ $v->label() }}">
                                    {{ $v->label() }}
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <div id="stockBadge" class="stock-badge {{ ($firstVariant?->stock ?? 0) > 0 ? 'in' : 'out' }}">
                <span class="stock-dot"></span>
                <span id="stockText">
                    @if(($firstVariant?->stock ?? 0) > 0)
                        Stok tersedia ({{ $firstVariant->stock }} unit)
                    @else
                        Stok habis
                    @endif
                </span>
            </div>

            <div id="attrSection">
                @if($firstVariant && !empty($firstVariant->attributes))
                    <table class="attr-table">
                        @foreach($firstVariant->attributes as $attr)
                            <tr>
                                <td>{{ $attr['key'] ?? '' }}</td>
                                <td>
                                    @if(!empty($attr['hex']))
                                        <span style="display:inline-flex;align-items:center;gap:6px">
                                            <span style="width:12px;height:12px;border-radius:50%;background:{{ $attr['hex'] }};border:1px solid rgba(0,0,0,.1);display:inline-block;flex-shrink:0"></span>
                                            {{ $attr['value'] ?? '' }}
                                        </span>
                                    @else
                                        {{ $attr['value'] ?? '' }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>

            <div class="cta-wrap">
                <a href="https://wa.me/6281112016231?text={{ urlencode('Halo, saya tertarik dengan produk ' . $product->name . ' (SKU: ' . ($firstVariant?->sku ?? '-') . '). Bisa info lebih lanjut?') }}"
                   class="btn-wa" id="waBtn" target="_blank" rel="noopener">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Hubungi via WhatsApp
                </a>
                <a href="{{ route('contact') }}" class="btn-inquiry">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Kirim Permintaan Penawaran
                </a>
            </div>

            {{-- Specs accordion --}}
            @php $variantSpecs = $firstVariant?->specifications ?? []; @endphp
            <div id="specsWrap">
                <button class="specs-toggle {{ count($variantSpecs) ? '' : 'hidden' }}" id="varSpecToggle" onclick="toggleSpecs(this)">
                    Spesifikasi Teknis
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="specs-body" id="varSpecBody">
                    @foreach($variantSpecs as $s)
                        <div class="specs-row">
                            <span class="specs-key">{{ $s['key'] ?? '' }}</span>
                            <span class="specs-val">{{ $s['value'] ?? '' }}</span>
                        </div>
                    @endforeach
                </div>

                @if(!empty($product->specifications))
                    <button class="specs-toggle" onclick="toggleSpecs(this)">
                        Spesifikasi Umum
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="specs-body">
                        @foreach($product->specifications as $s)
                            <div class="specs-row">
                                <span class="specs-key">{{ $s['key'] ?? '' }}</span>
                                <span class="specs-val">{{ $s['value'] ?? '' }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>{{-- /pdp-info --}}
    </div>{{-- /pdp-grid --}}

    @if($product->description)
        <div class="desc-section">
            <h2>Tentang Produk</h2>
            <p>{{ $product->description }}</p>
        </div>
    @endif

</div>

<script>

@php
    $variantsJson = $variants->keyBy('id')->map(fn($v) => $v->toPublicArray());
@endphp

const VARIANTS = @json($variantsJson);
const PRODUCT_NAME = @json($product->name);

function switchVariant(variantId) {
    const v = VARIANTS[variantId];
    if (!v) return;

    const priceEl = document.getElementById('currentPrice');
    priceEl.classList.add('updating');
    setTimeout(() => {
        priceEl.textContent = v.price;
        priceEl.classList.remove('updating');
    }, 150);

    document.getElementById('currentSku').textContent = v.sku;
    document.getElementById('chosenColorName').textContent = v.label;

    if (v.image_path) {
        const mainImg = document.getElementById('mainImg');
        if (mainImg) {
            mainImg.classList.add('fading');
            setTimeout(() => {
                mainImg.src = '/storage/' + v.image_path;
                mainImg.classList.remove('fading');
            }, 160);
        }
        document.querySelectorAll('.thumb').forEach(t =>
            t.classList.toggle('active', parseInt(t.dataset.vid) === variantId)
        );
    }

    const badge    = document.getElementById('stockBadge');
    const stockTxt = document.getElementById('stockText');
    badge.className = 'stock-badge ' + (v.stock > 0 ? 'in' : 'out');
    stockTxt.textContent = v.stock > 0
        ? `Stok tersedia (${v.stock} unit)`
        : 'Stok habis';

    const attrEl = document.getElementById('attrSection');
    if (v.attributes && v.attributes.length > 0) {
        let html = '<table class="attr-table">';
        v.attributes.forEach(a => {
            const dot = a.hex
                ? `<span style="width:12px;height:12px;border-radius:50%;background:${a.hex};border:1px solid rgba(0,0,0,.1);display:inline-block;margin-right:6px;vertical-align:middle;flex-shrink:0"></span>`
                : '';
            html += `<tr><td>${a.key || ''}</td><td>${dot}${a.value || ''}</td></tr>`;
        });
        html += '</table>';
        attrEl.innerHTML = html;
    } else {
        attrEl.innerHTML = '';
    }

    const varSpecToggle = document.getElementById('varSpecToggle');
    const varSpecBody   = document.getElementById('varSpecBody');
    if (v.specifications && v.specifications.length > 0) {
        let html = '';
        v.specifications.forEach(s => {
            html += `<div class="specs-row"><span class="specs-key">${s.key||''}</span><span class="specs-val">${s.value||''}</span></div>`;
        });
        varSpecBody.innerHTML = html;
        varSpecToggle.classList.remove('hidden');
    } else {
        varSpecBody.innerHTML = '';
        varSpecToggle.classList.add('hidden');
        varSpecToggle.classList.remove('open');
        varSpecBody.classList.remove('open');
    }

    const waBtn = document.getElementById('waBtn');
    if (waBtn) {
        const msg = encodeURIComponent(`Halo, saya tertarik dengan produk ${PRODUCT_NAME} (SKU: ${v.sku}). Bisa info lebih lanjut?`);
        waBtn.href = `https://wa.me/6281112016231?text=${msg}`;
    }

    document.querySelectorAll('.color-swatch, .variant-btn').forEach(b =>
        b.classList.toggle('active', parseInt(b.dataset.vid) === variantId)
    );
}

document.querySelectorAll('.color-swatch, .variant-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        switchVariant(parseInt(this.dataset.vid));
    });
});

document.querySelectorAll('.thumb').forEach(t => {
    t.addEventListener('click', function () {
        const vid = parseInt(this.dataset.vid);
        document.querySelectorAll('.thumb').forEach(x => x.classList.remove('active'));
        this.classList.add('active');
        if (VARIANTS[vid]) switchVariant(vid);
    });
});

function toggleSpecs(btn) {
    btn.classList.toggle('open');
    btn.nextElementSibling.classList.toggle('open');
}
</script>

@endsection
