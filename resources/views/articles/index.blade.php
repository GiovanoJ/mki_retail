@extends('layouts.app')

@section('title', 'Artikel')

@section('content')

<section style="background:var(--dark);padding:72px 0 52px;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\");"></div>
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;">
        <p style="font-size:.72rem;font-weight:500;letter-spacing:.12em;text-transform:uppercase;color:var(--gold);margin-bottom:12px;">Pusat Grosir MKI</p>
        <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2.5rem,5vw,4rem);font-weight:300;color:#f0ebe3;letter-spacing:-.02em;line-height:1.1;">
            Artikel & Tips
        </h1>
    </div>
</section>

<section style="background:var(--warm-bg);min-height:60vh;padding:60px 0 80px;">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

        @if($articles->isEmpty())
            <div style="text-align:center;padding:80px 0;">
                <svg style="width:48px;height:48px;color:var(--muted);margin:0 auto 16px;display:block;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                </svg>
                <p style="font-family:'Cormorant Garamond',serif;font-size:1.6rem;color:var(--dark);font-weight:300;">Belum ada artikel</p>
                <p style="color:var(--muted);font-size:.88rem;margin-top:6px;">Nantikan konten terbaru dari kami.</p>
            </div>
        @else
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:2px;background:var(--warm-mid);margin-bottom:48px;">
                @foreach($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}"
                       style="background:#fff;display:block;text-decoration:none;transition:transform .3s ease,box-shadow .3s ease;position:relative;overflow:hidden;"
                       onmouseover="this.style.transform='scale(1.02)';this.style.zIndex=2;this.style.boxShadow='0 20px 60px rgba(0,0,0,.15)'"
                       onmouseout="this.style.transform='';this.style.zIndex='';this.style.boxShadow=''">

                        <div style="aspect-ratio:16/9;background:var(--warm-mid);overflow:hidden;">
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                     alt="{{ $article->title }}"
                                     style="width:100%;height:100%;object-fit:cover;transition:transform .6s ease;"
                                     onmouseover="this.style.transform='scale(1.06)'"
                                     onmouseout="this.style.transform=''">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#f0ebe3,var(--warm-mid));">
                                    <svg style="width:40px;height:40px;opacity:.2;" fill="none" stroke="#1a1612" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div style="padding:24px 26px 28px;border-top:1px solid #f0ebe3;">
                            <p style="font-size:.68rem;font-weight:500;letter-spacing:.1em;text-transform:uppercase;color:var(--gold);margin-bottom:10px;">
                                {{ $article->created_at->format('d M Y') }}
                            </p>
                            <h2 style="font-family:'Cormorant Garamond',serif;font-size:1.25rem;font-weight:400;color:var(--dark);line-height:1.3;letter-spacing:-.01em;margin-bottom:10px;">
                                {{ $article->title }}
                            </h2>
                            <p style="font-size:.84rem;color:var(--muted);line-height:1.65;margin-bottom:18px;">
                                {{ Str::limit($article->sinopsis, 120) }}
                            </p>
                            <span style="display:inline-flex;align-items:center;gap:6px;font-size:.75rem;font-weight:500;letter-spacing:.06em;text-transform:uppercase;color:var(--dark);">
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
