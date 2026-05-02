@extends('layouts.app')

@section('title', 'Produk')

@section('content')

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
