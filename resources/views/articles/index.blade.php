@extends('layouts.app')

@section('title', 'Artikel')

@section('content')

<section class="articles-hero">
    <div class="articles-hero__inner">
        <p class="articles-hero__label">Pusat Grosir MKI</p>
        <h1 class="articles-hero__title">Artikel & Tips</h1>
    </div>
</section>

<section class="articles-index">
    <div class="articles-index__wrap">

        @if($articles->isEmpty())
            <div class="articles-empty">
                <svg class="articles-empty__icon" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                </svg>
                <p class="articles-empty__heading">Belum ada artikel</p>
                <p class="articles-empty__sub">Nantikan konten terbaru dari kami.</p>
            </div>
        @else
            <div class="articles-grid">
                @foreach($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}" class="article-card">

                        <div class="article-card__image">
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                     alt="{{ $article->title }}">
                            @else
                                <div class="article-card__placeholder">
                                    <svg width="40" height="40" fill="none" stroke="#1a1612" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div class="article-card__body">
                            <p class="article-card__date">{{ $article->created_at->format('d M Y') }}</p>
                            <h2 class="article-card__title">{{ $article->title }}</h2>
                            <p class="article-card__sinopsis">{{ Str::limit($article->sinopsis, 120) }}</p>
                            <span class="article-card__cta">
                                Baca Selengkapnya
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </span>
                        </div>

                    </a>
                @endforeach
            </div>

            @if($articles->hasPages())
                <div class="pagination-wrap">
                    {{ $articles->links() }}
                </div>
            @endif
        @endif

    </div>
</section>

@endsection
