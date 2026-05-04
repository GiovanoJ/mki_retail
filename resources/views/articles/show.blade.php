@extends('layouts.app')

@section('title', $article->title . ' — MKI')

@section('content')

<section style="background:var(--dark);padding:64px 0 48px;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\");"></div>
    <div style="max-width:800px;margin:0 auto;padding:0 24px;position:relative;">

        <nav style="display:flex;align-items:center;gap:8px;font-size:.72rem;color:rgba(240,235,227,.45);margin-bottom:24px;">
            <a href="{{ route('home') }}" style="color:rgba(240,235,227,.45);text-decoration:none;transition:color .2s;"
               onmouseover="this.style.color='rgba(240,235,227,.8)'" onmouseout="this.style.color='rgba(240,235,227,.45)'">Home</a>
            <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="opacity:.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('articles.index') }}" style="color:rgba(240,235,227,.45);text-decoration:none;transition:color .2s;"
               onmouseover="this.style.color='rgba(240,235,227,.8)'" onmouseout="this.style.color='rgba(240,235,227,.45)'">Artikel</a>
            <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="opacity:.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span style="color:rgba(240,235,227,.7);">{{ Str::limit($article->title, 40) }}</span>
        </nav>

        <p style="font-size:.68rem;font-weight:500;letter-spacing:.12em;text-transform:uppercase;color:var(--gold);margin-bottom:14px;">
            {{ $article->created_at->format('d M Y') }}
        </p>

        <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2rem,4vw,3rem);font-weight:300;color:#f0ebe3;letter-spacing:-.02em;line-height:1.15;margin-bottom:16px;">
            {{ $article->title }}
        </h1>

        <p style="font-size:.92rem;color:rgba(240,235,227,.65);line-height:1.7;">
            {{ $article->sinopsis }}
        </p>
    </div>
</section>

@if($article->thumbnail)
    <div style="background:var(--dark);padding:0 0 0;">
        <div style="max-width:900px;margin:0 auto;">
            <img src="{{ asset('storage/' . $article->thumbnail) }}"
                 alt="{{ $article->title }}"
                 style="width:100%;max-height:500px;object-fit:cover;display:block;">
        </div>
    </div>
@endif

<section style="background:var(--warm-bg);padding:60px 0 80px;">
    <div style="max-width:800px;margin:0 auto;padding:0 24px;">

        <article class="article-content" style="color:var(--text);font-family:'DM Sans',sans-serif;font-size:.96rem;line-height:1.85;">
            {!! $article->content !!}
        </article>

        <div style="margin-top:56px;padding-top:32px;border-top:1px solid var(--warm-mid);">
            <p style="font-size:.72rem;font-weight:500;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:16px;">Bagikan artikel ini</p>
            <div style="display:flex;flex-wrap:wrap;gap:10px;">
                <a href="https://wa.me/?text={{ urlencode($article->title . ' — ' . url()->current()) }}"
                   target="_blank"
                   style="display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border:1px solid var(--warm-mid);border-radius:4px;text-decoration:none;font-size:.8rem;font-weight:500;color:#25D366;font-family:'DM Sans',sans-serif;transition:border-color .2s,background .2s;"
                   onmouseover="this.style.borderColor='#25D366';this.style.background='rgba(37,211,102,.06)'"
                   onmouseout="this.style.borderColor='var(--warm-mid)';this.style.background=''">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    WhatsApp
                </a>
                <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}"
                   target="_blank"
                   style="display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border:1px solid var(--warm-mid);border-radius:4px;text-decoration:none;font-size:.8rem;font-weight:500;color:#229ED9;font-family:'DM Sans',sans-serif;transition:border-color .2s,background .2s;"
                   onmouseover="this.style.borderColor='#229ED9';this.style.background='rgba(34,158,217,.06)'"
                   onmouseout="this.style.borderColor='var(--warm-mid)';this.style.background=''">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                    </svg>
                    Telegram
                </a>
            </div>
        </div>

    </div>
</section>

@if($relatedArticles->isNotEmpty())
    <section style="background:#fff;padding:60px 0 80px;border-top:1px solid var(--warm-mid);">
        <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
            <h2 style="font-family:'Cormorant Garamond',serif;font-size:1.8rem;font-weight:300;color:var(--dark);letter-spacing:-.02em;margin-bottom:32px;">
                Artikel Lainnya
            </h2>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:2px;background:var(--warm-mid);">
                @foreach($relatedArticles as $rel)
                    <a href="{{ route('articles.show', $rel->slug) }}"
                       style="background:#fff;display:block;text-decoration:none;transition:transform .3s,box-shadow .3s;"
                       onmouseover="this.style.transform='scale(1.02)';this.style.zIndex=2;this.style.boxShadow='0 20px 60px rgba(0,0,0,.12)'"
                       onmouseout="this.style.transform='';this.style.zIndex='';this.style.boxShadow=''">
                        <div style="aspect-ratio:16/9;background:var(--warm-mid);overflow:hidden;">
                            @if($rel->thumbnail)
                                <img src="{{ asset('storage/' . $rel->thumbnail) }}"
                                     alt="{{ $rel->title }}"
                                     style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#f0ebe3,var(--warm-mid));">
                                    <svg style="width:32px;height:32px;opacity:.2;" fill="none" stroke="#1a1612" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div style="padding:20px 22px 24px;border-top:1px solid #f0ebe3;">
                            <p style="font-size:.65rem;letter-spacing:.08em;text-transform:uppercase;color:var(--gold);margin-bottom:8px;">
                                {{ $rel->created_at->format('d M Y') }}
                            </p>
                            <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:400;color:var(--dark);line-height:1.3;margin-bottom:8px;">
                                {{ $rel->title }}
                            </h3>
                            <p style="font-size:.8rem;color:var(--muted);line-height:1.6;">
                                {{ Str::limit($rel->sinopsis, 90) }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

<style>
.article-content h1,
.article-content h2,
.article-content h3,
.article-content h4 {
    font-family: 'Cormorant Garamond', serif;
    color: var(--dark);
    letter-spacing: -.01em;
    margin: 2em 0 .75em;
    line-height: 1.2;
}
.article-content h2 { font-size: 1.65rem; font-weight: 400; }
.article-content h3 { font-size: 1.3rem; font-weight: 400; }
.article-content p  { margin: 0 0 1.4em; }
.article-content a  { color: var(--gold); text-decoration: underline; text-decoration-color: rgba(200,169,110,.4); }
.article-content a:hover { text-decoration-color: var(--gold); }
.article-content ul,
.article-content ol { padding-left: 1.5em; margin: 0 0 1.4em; }
.article-content li { margin-bottom: .5em; }
.article-content blockquote {
    border-left: 3px solid var(--gold);
    margin: 2em 0;
    padding: 1em 1.5em;
    background: rgba(200,169,110,.06);
    font-style: italic;
    color: var(--muted);
}
.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 6px;
    margin: 1.5em 0;
}
.article-content figure { margin: 2em 0; }
.article-content figcaption {
    font-size: .78rem;
    color: var(--muted);
    text-align: center;
    margin-top: 8px;
}
.article-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5em 0;
    font-size: .88rem;
}
.article-content th,
.article-content td {
    padding: 10px 14px;
    border: 1px solid var(--warm-mid);
    text-align: left;
}
.article-content th {
    background: var(--warm-mid);
    font-weight: 500;
    color: var(--dark);
}
</style>

@endsection
