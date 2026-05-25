@extends('layouts.app')

@section('title', 'Pusat Grosir MKI — Material Bangunan Premium')

@section('content')

{{-- ═══════════════════════════════════════════════════════════
     SECTION 1: HERO
     ═══════════════════════════════════════════════════════════ --}}
<section class="home-hero">
    <img id="hero-bg-out"
         class="home-hero__bg-img hero-bg-active"
         src="/img/herozoomedout.webp"
         alt="Material bangunan premium MKI — tampilan luas">
    <img id="hero-bg-in"
         class="home-hero__bg-img hero-bg-inactive"
         src="/img/herozoomedin.webp"
         alt="Material bangunan premium MKI — tampilan detail">

    <div class="home-hero__overlay"></div>
    <div class="home-hero__overlay-bottom"></div>
    <div class="home-hero__accent-top"></div>
    <div class="home-hero__accent-left"></div>

    <div class="home-hero__content">
        <div class="home-hero__left">
            <p class="home-hero__eyebrow">Pusat Grosir PVC WPC</p>

            <h1 class="home-hero__title">
                Grosir Terbesar<br>
                <em>Produk Interior, Eksterior</em><br>
                Harga Termurah.
            </h1>

            <p class="home-hero__sub">
                Distributor wall panel, plafon pvc, decking, facade, dan material komposit premium.
                Harga grosir.
            </p>

            <div class="home-hero__ctas">
                <a href="{{ route('products.index') }}" class="home-hero__cta-primary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h7"/>
                    </svg>
                    Lihat Katalog
                </a>
                <a href="https://wa.me/6281112016231?text={{ urlencode('Halo, saya ingin bertanya mengenai produk MKI.') }}"
                   target="_blank" rel="noopener"
                   class="home-hero__cta-secondary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Chat WhatsApp
                </a>
                <a href="#showroom" class="home-hero__cta-secondary home-hero__cta-showroom">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 22V12h6v10"/>
                    </svg>
                    Kunjungi Showroom
                </a>
            </div>
        </div>

        <div class="home-hero__right">
            <div class="home-hero__stats">
                <div class="home-hero__stat">
                    <div class="home-hero__stat-num">500<span>+</span></div>
                    <div class="home-hero__stat-label">Proyek Selesai</div>
                </div>
                <div class="home-hero__stat">
                    <div class="home-hero__stat-num">10<span>+</span></div>
                    <div class="home-hero__stat-label">Tahun Pengalaman</div>
                </div>
                <div class="home-hero__stat">
                    <div class="home-hero__stat-num">34</div>
                    <div class="home-hero__stat-label">Kota Terjangkau</div>
                </div>
                <div class="home-hero__stat">
                    <div class="home-hero__stat-num">98<span>%</span></div>
                    <div class="home-hero__stat-label">Klien Puas</div>
                </div>
            </div>
        </div>
    </div>

    <div class="home-hero__scroll">
        <div class="home-hero__scroll-line"></div>
        <span>Scroll</span>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     SECTION 2: USP STRIP
     ═══════════════════════════════════════════════════════════ --}}
<section class="home-usp">
    <div class="home-usp__inner">
        <div class="home-usp__item">
            <div class="home-usp__icon">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
            </div>
            <div>
                <p class="home-usp__title">Produk Bersertifikat</p>
                <p class="home-usp__desc">Standar SNI &amp; internasional, teruji kualitasnya</p>
            </div>
        </div>

        <div class="home-usp__item">
            <div class="home-usp__icon">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="home-usp__title">Harga Grosir</p>
                <p class="home-usp__desc">Langsung dari produsen, tanpa perantara</p>
            </div>
        </div>

        <div class="home-usp__item">
            <div class="home-usp__icon">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </div>
            <div>
                <p class="home-usp__title">Konsultasi Gratis</p>
                <p class="home-usp__desc">Tim ahli siap membantu pilih material terbaik</p>
            </div>
        </div>

        <div class="home-usp__item">
            <div class="home-usp__icon">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2zM9 22V12h6v10"/>
                </svg>
            </div>
            <div>
                <p class="home-usp__title">Showroom Lengkap</p>
                <p class="home-usp__desc">Lihat &amp; sentuh langsung semua koleksi material kami</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     SECTION 3: PRODUK UNGGULAN
     ═══════════════════════════════════════════════════════════ --}}
<section class="home-products">
    <div class="home-products__inner">
        <div class="home-products__head reveal">
            <div>
                <p class="home-section-label">Koleksi Kami</p>
                <h2 class="home-products__title">Produk Unggulan</h2>
            </div>
            <a href="{{ route('products.index') }}" class="home-products__all">
                Lihat Semua
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>

        <div class="home-products__grid">
            @forelse($featured as $product)
                @php
                    $img      = $product->firstImage();
                    $variants = $product->variants ?? collect();
                    $swatches = $variants->filter(fn($v) => $v->colorHex())->take(5);
                    $extraVars= $variants->count() - $swatches->count();
                @endphp
                <a href="{{ route('products.show', $product) }}" class="product-card reveal reveal-delay-{{ ($loop->index % 4) + 1 }}">
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
                                    <span class="card-swatch" style="background:{{ $v->colorHex() }}" title="{{ $v->label() }}"></span>
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
                <div style="grid-column:1/-1;padding:60px;text-align:center;background:#fff">
                    <p style="color:var(--muted);font-size:.9rem">Belum ada produk ditampilkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     SECTION 4: KONSULTASI
     ═══════════════════════════════════════════════════════════ --}}
<section class="home-konsultasi">
    <div class="home-konsultasi__inner">

        <div class="home-konsultasi__left reveal">
            <p class="home-section-label" style="color:rgba(200,169,110,.7)">Mudah &amp; Cepat</p>
            <h2 class="home-konsultasi__title">
                Konsultasi<br>
                <em>Material Anda</em>
            </h2>
            <p class="home-konsultasi__desc">
                Kami membantu Anda menemukan material terbaik sesuai kebutuhan proyek,
                anggaran, dan estetika yang diinginkan.
            </p>

            <div class="home-konsultasi__steps">
                <div class="home-konsultasi__step">
                    <div class="home-konsultasi__step-num">01</div>
                    <div class="home-konsultasi__step-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="home-konsultasi__step-title">Ceritakan Kebutuhan Anda</p>
                        <p class="home-konsultasi__step-desc">Jelaskan proyek, lokasi, anggaran, dan preferensi material. Makin detail, makin tepat rekomendasi kami.</p>
                    </div>
                </div>

                <div class="home-konsultasi__step">
                    <div class="home-konsultasi__step-num">02</div>
                    <div class="home-konsultasi__step-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="home-konsultasi__step-title">Diskusi dengan Tim Ahli</p>
                        <p class="home-konsultasi__step-desc">Tim ahli kami menganalisa kebutuhan dan menyiapkan rekomendasi produk beserta estimasi harga terbaik.</p>
                    </div>
                </div>

                <div class="home-konsultasi__step">
                    <div class="home-konsultasi__step-num">03</div>
                    <div class="home-konsultasi__step-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="home-konsultasi__step-title">Terima Penawaran Resmi</p>
                        <p class="home-konsultasi__step-desc">Dapatkan penawaran lengkap dengan spesifikasi teknis, harga grosir, dan jadwal pengiriman ke lokasi Anda.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="home-konsultasi__form reveal reveal-delay-2">
            <div class="home-konsultasi__form-head">
                <h3 class="home-konsultasi__form-title">Formulir Konsultasi</h3>
                <p class="home-konsultasi__form-sub">Isi formulir ini — tim kami akan menghubungi Anda dalam 1×24 jam kerja.</p>
            </div>

            <form action="{{ route('contact.send') }}" method="POST" class="home-konsultasi__form-body">
                @csrf
                <div class="home-konsultasi__form-grid">
                    <div class="home-konsultasi__field">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" placeholder="Budi Santoso" required>
                    </div>
                    <div class="home-konsultasi__field">
                        <label>No. WhatsApp</label>
                        <input type="text" name="phone" placeholder="0812-xxxx-xxxx">
                    </div>
                </div>

                <div class="home-konsultasi__field">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="budi@perusahaan.com" required>
                </div>

                <div class="home-konsultasi__field">
                    <label>Jenis Proyek</label>
                    <select name="subject">
                        <option value="">Pilih jenis proyek...</option>
                        <option>Residensial / Rumah Tinggal</option>
                        <option>Gedung Komersial</option>
                        <option>Hotel &amp; Hospitality</option>
                        <option>Perkantoran</option>
                        <option>Industrial</option>
                    </select>
                </div>

                <div class="home-konsultasi__field">
                    <label>Produk yang Diminati</label>
                    <select name="product_interest">
                        <option value="">Pilih produk...</option>
                        <option>Wall Panel</option>
                        <option>Decking</option>
                        <option>Facade / Cladding</option>
                        <option>Kombinasi Produk</option>
                        <option>Belum Tahu / Minta Rekomendasi</option>
                    </select>
                </div>

                <div class="home-konsultasi__field">
                    <label>Deskripsi Singkat Kebutuhan</label>
                    <textarea name="message" rows="3"
                            placeholder="Contoh: Butuh wall panel untuk eksterior gedung 5 lantai di Jakarta, luas ±800 m²..."
                            required></textarea>
                </div>

                <button type="submit" class="home-konsultasi__submit">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Kirim Permintaan Konsultasi
                </button>

                <p class="home-konsultasi__note">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Data Anda aman. Tidak akan dibagikan ke pihak ketiga.
                </p>
            </form>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     SECTION 5: SHOWROOM
     ═══════════════════════════════════════════════════════════ --}}
<section class="home-showroom" id="showroom">
    <div class="home-showroom__inner">


        <div class="home-showroom__info reveal">
            <p class="home-section-label">Temukan Kami</p>
            <h2 class="home-showroom__title">
                Kunjungi<br>Showroom Kami
            </h2>
            <p class="home-showroom__desc">
                Lihat dan sentuh langsung kualitas material MKI. Showroom kami menampilkan
                seluruh koleksi produk dengan contoh pemasangan nyata yang bisa Anda
                jadikan referensi proyek.
            </p>

            <div class="home-showroom__items">
                <div class="home-showroom__item">
                    <div class="home-showroom__item-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="home-showroom__item-title">Alamat Showroom</p>
                        <p class="home-showroom__item-val">
                            Jl. Joglo Raya No.21, RT.12/RW.1, Joglo, Kec. Kembangan,<br>
                            Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11640
                        </p>
                    </div>
                </div>

                <div class="home-showroom__item">
                    <div class="home-showroom__item-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="home-showroom__item-title">Jam Operasional</p>
                        <p class="home-showroom__item-val">
                            Senin – Jumat: 08.30 – 17.00 WIB<br>
                            Sabtu: 08.30 – 12.00 WIB &nbsp;·&nbsp; Minggu: Tutup
                        </p>
                    </div>
                </div>

                <div class="home-showroom__item">
                    <div class="home-showroom__item-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="home-showroom__item-title">Reservasi Kunjungan</p>
                        <p class="home-showroom__item-val">
                            +62 811 1201 6231 (WhatsApp)<br>
                            Hubungi kami sebelum berkunjung untuk layanan terbaik
                        </p>
                    </div>
                </div>
            </div>

            <div class="home-showroom__ctas">
                <a href="https://maps.google.com" target="_blank" rel="noopener" class="home-showroom__btn-map">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    Lihat di Google Maps
                </a>
                <a href="https://wa.me/6281112016231?text={{ urlencode('Halo, saya ingin reservasi kunjungan ke showroom MKI.') }}"
                   target="_blank" rel="noopener"
                   class="home-showroom__btn-wa">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Reservasi Kunjungan
                </a>
            </div>
        </div>

        <div class="home-showroom__gallery reveal reveal-delay-2">
            <div class="home-showroom__gallery-grid">
                <div class="home-showroom__gallery-item home-showroom__gallery-item--large">
                    <div class="home-showroom__gallery-placeholder">
                        <img
                            src="{{ asset('img/showroom1.webp') }}"
                            alt="Showroom"
                            width="36"
                            height="36"
                        >
                    </div>
                    <div class="home-showroom__gallery-hover"></div>
                </div>
                <div class="home-showroom__gallery-item">
                    <div class="home-showroom__gallery-placeholder">
                        <img
                            src="{{ asset('img/showroom2.webp') }}"
                            alt="Showroom"
                            width="28"
                            height="30"
                        >
                        <span>Display Wall Panel</span>
                    </div>
                    <div class="home-showroom__gallery-hover"></div>
                </div>
                <div class="home-showroom__gallery-item">
                    <div class="home-showroom__gallery-placeholder">
                        <img
                            src="{{ asset('img/showroom3.webp') }}"
                            alt="Showroom"
                            width="28"
                            height="28"
                        >
                    </div>
                    <div class="home-showroom__gallery-hover"></div>
                </div>
            </div>

            {{-- Peta / Embed Google Maps --}}
            {{-- <div class="home-showroom__map">
                {{-- Ganti dengan embed Google Maps iframe nyata:
                <iframe
                    src="https://www.google.com/maps/embed?pb=..."
                    width="100%" height="130" style="border:0" allowfullscreen loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                --}}
                {{-- <div class="home-showroom__map-placeholder">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="color:var(--gold)">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    <span>Peta menuju showroom MKI — Pulogadung, Jakarta Timur</span>
                </div>
            </div> --}}
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     SECTION 6: KEPERCAYAAN — STATISTIK + TESTIMONI
     ═══════════════════════════════════════════════════════════ --}}
{{-- <section class="home-trust">
    <div class="home-trust__inner"> --}}
        {{-- <div>
            <p class="home-section-label reveal">Angka Bicara</p>
            <div class="home-trust__stats">
                <div class="home-trust__stat reveal reveal-delay-1">
                    <div class="home-trust__stat-num">500<span>+</span></div>
                    <p class="home-trust__stat-label">Proyek selesai</p>
                </div>
                <div class="home-trust__stat reveal reveal-delay-2">
                    <div class="home-trust__stat-num">10<span>+</span></div>
                    <p class="home-trust__stat-label">Tahun pengalaman</p>
                </div>
                <div class="home-trust__stat reveal reveal-delay-3">
                    <div class="home-trust__stat-num">34</div>
                    <p class="home-trust__stat-label">Kota terjangkau</p>
                </div>
                <div class="home-trust__stat reveal reveal-delay-4">
                    <div class="home-trust__stat-num">98<span>%</span></div>
                    <p class="home-trust__stat-label">Klien puas</p>
                </div>
            </div>
        </div> --}}

        {{-- <div>
            <p class="home-section-label home-trust__testi-label reveal">Kata Mereka</p>

            <div class="home-testi reveal reveal-delay-1">
                <div class="home-testi__stars">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--gold)"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--gold)"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--gold)"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--gold)"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--gold)"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>
                <p class="home-testi__quote">
                    "Kualitas wall panel MKI jauh melampaui ekspektasi. Pemasangan mudah, finishing rapi, dan tahan terhadap cuaca ekstrem di lokasi proyek kami."
                </p>
                <div class="home-testi__author">
                    <div class="home-testi__avatar">BS</div>
                    <div>
                        <p class="home-testi__name">Budi Santoso</p>
                        <p class="home-testi__company">Kontraktor — PT. Bangun Nusantara</p>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="home-testi reveal reveal-delay-2">
                <div class="home-testi__stars">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--gold)"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--gold)"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--gold)"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--gold)"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--gold)"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>
                <p class="home-testi__quote">
                    "Harga grosir yang kompetitif dan pengiriman selalu tepat waktu. Sudah 3 tahun kami bermitra dengan MKI untuk proyek-proyek properti komersial kami."
                </p>
                <div class="home-testi__author">
                    <div class="home-testi__avatar">RA</div>
                    <div>
                        <p class="home-testi__name">Rina Andika</p>
                        <p class="home-testi__company">Arsitek — Studio Rupa Desain</p>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="home-testi reveal reveal-delay-3">
                <div class="home-testi__stars">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--gold)"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--gold)"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--gold)"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--gold)"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="var(--gold)" opacity=".4"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>
                <p class="home-testi__quote">
                    "Tim konsultasi MKI sangat membantu. Mereka merekomendasikan material yang pas untuk facade hotel kami — hasilnya elegan dan sesuai budget."
                </p>
                <div class="home-testi__author">
                    <div class="home-testi__avatar">DH</div>
                    <div>
                        <p class="home-testi__name">Dharma Hartono</p>
                        <p class="home-testi__company">Project Manager — Harmoni Hotel Group</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

{{-- ═══════════════════════════════════════════════════════════
     SECTION 7: GALERI PROYEK
     ═══════════════════════════════════════════════════════════ --}}
<section class="home-gallery">
    <div class="home-gallery__inner">
        <div class="home-gallery__head reveal">
            <div>
                <p class="home-section-label">Hasil Nyata</p>
                <h2 class="home-gallery__title">Proyek Terpasang</h2>
            </div>
            <a href="#" class="home-products__all">
                Lihat Semua
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>

        <div class="home-gallery__grid">
            <div class="home-gallery__item">
                <div class="home-gallery__placeholder">
                    <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24" style="opacity:.35">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                    </svg>
                    <span>Wall Panel — Gedung Perkantoran</span>
                </div>
                <div class="home-gallery__item-overlay"></div>
                <div class="home-gallery__item-caption"><p>Wall Panel — Gedung Perkantoran</p></div>
            </div>
            <div class="home-gallery__item">
                <div class="home-gallery__placeholder">
                    <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24" style="opacity:.35">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                    </svg>
                    <span>Decking — Rooftop Residensial</span>
                </div>
                <div class="home-gallery__item-overlay"></div>
                <div class="home-gallery__item-caption"><p>Decking — Rooftop Residensial</p></div>
            </div>
            <div class="home-gallery__item">
                <div class="home-gallery__placeholder">
                    <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24" style="opacity:.35">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                    </svg>
                    <span>Facade — Hotel Bintang Lima</span>
                </div>
                <div class="home-gallery__item-overlay"></div>
                <div class="home-gallery__item-caption"><p>Facade — Hotel Bintang Lima</p></div>
            </div>
            <div class="home-gallery__item">
                <div class="home-gallery__placeholder">
                    <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24" style="opacity:.35">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                    </svg>
                    <span>Cladding — Mall Premium</span>
                </div>
                <div class="home-gallery__item-overlay"></div>
                <div class="home-gallery__item-caption"><p>Cladding — Mall Premium</p></div>
            </div>
            <div class="home-gallery__item">
                <div class="home-gallery__placeholder">
                    <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24" style="opacity:.35">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/>
                    </svg>
                    <span>Decking — Area Pool</span>
                </div>
                <div class="home-gallery__item-overlay"></div>
                <div class="home-gallery__item-caption"><p>Decking — Area Pool</p></div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     SECTION 8: ARTIKEL TERBARU
     ═══════════════════════════════════════════════════════════ --}}
@if(isset($latestArticles) && $latestArticles->isNotEmpty())
<section class="home-articles">
    <div class="home-articles__inner">
        <div class="home-articles__head reveal">
            <div>
                <p class="home-section-label">Tips &amp; Inspirasi</p>
                <h2 class="home-articles__title">Artikel Terbaru</h2>
            </div>
            <a href="{{ route('articles.index') }}" class="home-products__all">
                Semua Artikel
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>

        <div class="home-articles__grid">
            @foreach($latestArticles as $article)
                <a href="{{ route('articles.show', $article->slug) }}"
                   class="article-card reveal reveal-delay-{{ $loop->index + 1 }}">
                    <div class="article-card__image">
                        @if($article->thumbnail)
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}">
                        @else
                            <div class="article-card__placeholder">
                                <svg width="36" height="36" fill="none" stroke="#1a1612" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="article-card__body">
                        <p class="article-card__date">{{ $article->created_at->format('d M Y') }}</p>
                        <h3 class="article-card__title">{{ $article->title }}</h3>
                        <p class="article-card__sinopsis">{{ Str::limit($article->sinopsis, 100) }}</p>
                        <span class="article-card__cta">
                            Baca Selengkapnya
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════
     SECTION 9: CTA PENUTUP
     ═══════════════════════════════════════════════════════════ --}}
<section class="home-cta">
    <div class="home-cta__inner">
        <div class="reveal">
            <p class="home-section-label" style="color:rgba(200,169,110,.7)">Mulai Sekarang</p>
            <h2 class="home-cta__title">
                Siap wujudkan<br>
                proyek <em>impian Anda?</em>
            </h2>
            <p class="home-cta__sub">
                Konsultasikan kebutuhan material bangunan Anda bersama tim kami.
                Gratis, tanpa komitmen, langsung dapat penawaran terbaik.
            </p>
        </div>

        <div class="home-cta__buttons reveal reveal-delay-2">
            <a href="https://wa.me/6281112016231?text={{ urlencode('Halo, saya ingin berkonsultasi mengenai kebutuhan material bangunan.') }}"
               target="_blank" rel="noopener"
               class="home-cta__btn-wa">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Chat WA Sekarang
            </a>
            <a href="{{ route('contact') }}" class="home-cta__btn-inquiry">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Kirim Penawaran
            </a>
        </div>
    </div>
</section>

<script>
(function () {
    /* ─── Hero Image Crossfade ─────────────────────────────────
       Mulai dengan herozoomedout.webp (tampilan lebar),
       setiap 5 detik berganti ke herozoomedin.webp dan sebaliknya.
       Transition CSS opacity 1.8s memberikan efek crossfade halus.
    ──────────────────────────────────────────────────────────── */
    var imgOut = document.getElementById('hero-bg-out'); // zoomed out (aktif duluan)
    var imgIn  = document.getElementById('hero-bg-in');  // zoomed in  (standby)

    if (imgOut && imgIn) {
        var showingOut = true;

        // Preload gambar kedua supaya transisi mulus
        var preload = new Image();
        preload.src = imgIn.src;

        setInterval(function () {
            showingOut = !showingOut;
            if (showingOut) {
                // Kembali ke zoomed out
                imgOut.classList.add('hero-bg-active');
                imgOut.classList.remove('hero-bg-inactive');
                imgIn.classList.add('hero-bg-inactive');
                imgIn.classList.remove('hero-bg-active');
            } else {
                // Pindah ke zoomed in
                imgIn.classList.add('hero-bg-active');
                imgIn.classList.remove('hero-bg-inactive');
                imgOut.classList.add('hero-bg-inactive');
                imgOut.classList.remove('hero-bg-active');
            }
        }, 7000);
    }

    /* ─── Scroll Reveal ────────────────────────────────────── */
    var els = document.querySelectorAll('.reveal');
    if (!els.length) return;
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    els.forEach(function (el) { io.observe(el); });

    /* ─── Smooth Scroll ke Showroom ────────────────────────── */
    document.querySelectorAll('a[href="#showroom"]').forEach(function (a) {
        a.addEventListener('click', function (e) {
            e.preventDefault();
            var target = document.getElementById('showroom');
            if (target) target.scrollIntoView({ behavior: 'smooth' });
        });
    });
})();
</script>

@endsection
