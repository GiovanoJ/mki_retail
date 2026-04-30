@extends('layouts.app')

@section('title', 'Produk')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap');

    .page-products {
        font-family: 'DM Sans', sans-serif;
        background: #f7f5f2;
        min-height: 100vh;
    }

    /* Tabs */
    .tab-bar {
        background: #fff;
        border-bottom: 1px solid #e8e4df;
        position: sticky;
        top: 64px;
        z-index: 40;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    }
    .tab-list {
        display: flex;
        gap: 0;
        overflow-x: auto;
        scrollbar-width: none;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 24px;
    }
    .tab-list::-webkit-scrollbar { display: none; }
    .tab-item {
        flex-shrink: 0;
        padding: 18px 22px;
        font-size: 0.8rem;
        font-weight: 500;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #9e9589;
        border-bottom: 2px solid transparent;
        text-decoration: none;
        transition: color 0.2s, border-color 0.2s;
        white-space: nowrap;
    }
    .tab-item:hover { color: #1a1612; }
    .tab-item.active {
        color: #1a1612;
        border-bottom-color: #c8a96e;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2px;
        background: #e8e4df;
    }

    .product-card {
        background: #fff;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
        text-decoration: none;
        display: block;
    }
    .product-card:hover {
        z-index: 2;
        transform: scale(1.02);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }

    .card-image {
        aspect-ratio: 4/3;
        background: #f0ebe3;
        overflow: hidden;
        position: relative;
    }
    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .product-card:hover .card-image img { transform: scale(1.08); }
    .card-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f0ebe3, #e8e4df);
    }
    .card-image-placeholder svg { opacity: 0.25; }

    .card-cats {
        position: absolute;
        top: 12px;
        left: 12px;
        display: flex;
        gap: 4px;
        flex-wrap: wrap;
    }
    .cat-badge {
        background: rgba(26,22,18,0.75);
        color: #f0ebe3;
        font-size: 0.65rem;
        font-weight: 500;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 3px 8px;
        border-radius: 2px;
        backdrop-filter: blur(4px);
    }

    .card-body {
        padding: 20px 22px 22px;
        border-top: 1px solid #f0ebe3;
    }
    .card-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.15rem;
        font-weight: 400;
        color: #1a1612;
        line-height: 1.3;
        margin-bottom: 6px;
        letter-spacing: -0.01em;
    }
    .card-price {
        font-size: 0.85rem;
        color: #c8a96e;
        font-weight: 500;
        letter-spacing: 0.02em;
    }
    .card-swatches {
        display: flex;
        gap: 5px;
        margin-top: 10px;
        align-items: center;
    }
    .card-swatch {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        border: 1.5px solid rgba(255,255,255,0.8);
        box-shadow: 0 0 0 1px rgba(0,0,0,0.12);
    }
    .card-variant-count {
        font-size: 0.72rem;
        color: #9e9589;
        margin-top: 4px;
    }

    .empty-state {
        grid-column: 1 / -1;
        padding: 100px 24px;
        text-align: center;
        background: #fff;
    }
    .empty-state h3 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        color: #1a1612;
        font-weight: 300;
        margin-bottom: 8px;
    }
    .empty-state p { color: #9e9589; font-size: 0.9rem; }

    .pagination-wrap nav > div:last-child {
        display: flex;
        justify-content: center;
        gap: 4px;
        padding: 40px 0;
    }
    .pagination-wrap span[aria-current="page"] > span,
    .pagination-wrap a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 8px;
        font-size: 0.8rem;
        border-radius: 3px;
        border: 1px solid #e8e4df;
        color: #1a1612;
        text-decoration: none;
        background: #fff;
        transition: background 0.2s, border-color 0.2s;
    }
    .pagination-wrap a:hover {
        background: #f7f5f2;
        border-color: #c8a96e;
    }
    .pagination-wrap span[aria-current="page"] > span {
        background: #1a1612;
        border-color: #1a1612;
        color: #fff;
    }

    .result-info {
        max-width: 1280px;
        margin: 0 auto;
        padding: 24px 24px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
    .result-info p {
        font-size: 0.8rem;
        color: #9e9589;
        letter-spacing: 0.03em;
    }
    .search-form { display: flex; gap: 8px; }
    .search-form input {
        background: #fff;
        border: 1px solid #e8e4df;
        border-radius: 3px;
        padding: 8px 14px;
        font-size: 0.82rem;
        font-family: 'DM Sans', sans-serif;
        color: #1a1612;
        outline: none;
        width: 200px;
        transition: border-color 0.2s;
    }
    .search-form input:focus { border-color: #c8a96e; }
    .search-form input::placeholder { color: #c4bdb4; }
    .search-form button {
        background: #1a1612;
        color: #f0ebe3;
        border: none;
        border-radius: 3px;
        padding: 8px 16px;
        font-size: 0.78rem;
        font-family: 'DM Sans', sans-serif;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.2s;
    }
    .search-form button:hover { background: #2d2721; }

    .grid-wrap {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 24px 60px;
    }
</style>

<div class="page-products">
    <x-promo-hero :promos="$promos" />

    <div class="tab-bar">
        <div class="tab-list">
            @foreach($tabs as $slug => $label)
                <a href="{{ route('products.index', $slug !== 'all' ? ['category' => $slug] : []) }}"
                   class="tab-item {{ $activeTab === $slug ? 'active' : '' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="result-info">
        <p>
            {{ $products->total() }} produk ditemukan
            @if($activeTab !== 'all')
                dalam <strong style="color:#1a1612">{{ $tabs[$activeTab] ?? $activeTab }}</strong>
            @endif
        </p>
        <form method="GET" action="{{ route('products.index') }}" class="search-form">
            @if($activeTab !== 'all')
                <input type="hidden" name="category" value="{{ $activeTab }}">
            @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk...">
            <button type="submit">Cari</button>
        </form>
    </div>

    <div class="grid-wrap">
        <div class="products-grid">
            @forelse($products as $product)
                @php
                    $img      = $product->firstImage();
                    $variants = $product->variants;
                    $swatches = $variants->filter(fn($v) => $v->colorHex())->take(5);
                    $extraVars= $variants->count() - $swatches->count();
                @endphp
                <a href="{{ route('products.show', $product) }}" class="product-card">
                    <div class="card-image">
                        @if($img)
                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $product->name }}" loading="lazy">
                        @else
                            <div class="card-image-placeholder">
                                <svg width="48" height="48" fill="none" stroke="#1a1612" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                                </svg>
                            </div>
                        @endif
                        @if(count($product->categoryLabels()) > 0)
                            <div class="card-cats">
                                @foreach($product->categoryLabels() as $label)
                                    <span class="cat-badge">{{ $label }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="card-name">{{ $product->name }}</div>
                        <div class="card-price">{{ $product->formattedPrice() }}</div>
                        @if($swatches->isNotEmpty())
                            <div class="card-swatches">
                                @foreach($swatches as $v)
                                    <span class="card-swatch"
                                          style="background:{{ $v->colorHex() }}"
                                          title="{{ $v->label() }}"></span>
                                @endforeach
                                @if($extraVars > 0)
                                    <span class="card-variant-count">+{{ $extraVars }} lagi</span>
                                @endif
                            </div>
                        @elseif($variants->count() > 1)
                            <p class="card-variant-count">{{ $variants->count() }} varian tersedia</p>
                        @endif
                    </div>
                </a>
            @empty
                <div class="empty-state">
                    <h3>Belum ada produk</h3>
                    <p>Coba pilih kategori lain atau hapus filter pencarian.</p>
                </div>
            @endforelse
        </div>

        @if($products->hasPages())
            <div class="pagination-wrap">
                {{ $products->links() }}
            </div>
        @endif
    </div>

</div>

@endsection
