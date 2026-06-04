@extends('layouts.app')

@section('title', 'Contact')

@section('content')

<div class="contact-page">

    <div class="contact-hero">
        <div class="contact-hero-inner">
            <h1>Hubungi Kami</h1>
        </div>
    </div>

    @if(session('success'))
        <div class="flash-success">
            <div class="flash-success-inner">
                ✓ {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="contact-wrap">

        <div class="contact-info">

            <p class="info-label">Pusat Grosir MKI</p>
            <h2 class="info-heading">Kami siap membantu<br><em>kebutuhan Anda</em></h2>
            <p class="info-sub">
                Konsultasikan kebutuhan material bangunan Anda dengan tim kami.
                Kami menyediakan solusi terbaik dengan produk berkualitas tinggi.
            </p>

            <div class="contact-cards">
                <a href="https://wa.me/6281112016231" target="_blank" rel="noopener" class="contact-card">
                    <div class="contact-card-icon wa">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#25D366">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact-card-label">WhatsApp</div>
                        <div class="contact-card-value">+62 811-1201-6231</div>
                    </div>
                    <svg class="contact-card-arrow" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>

                <a href="mailto:info@megakomposit.com" class="contact-card">
                    <div class="contact-card-icon mail">
                        <svg width="20" height="20" fill="none" stroke="#c8a96e" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact-card-label">Email</div>
                        <div class="contact-card-value">info@megakomposit.com</div>
                    </div>
                    <svg class="contact-card-arrow" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>

                <div class="contact-card" style="cursor:default">
                    <div class="contact-card-icon addr">
                        <svg width="20" height="20" fill="none" stroke="#1a1612" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="contact-card-label">Alamat</div>
                        <div class="contact-card-value">Jl. Joglo Raya No.21, RT.12/RW.1, Joglo, Kec. Kembangan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11640</div>
                    </div>
                </div>
            </div>

            <a href="https://wa.me/6281112016231?text={{ urlencode('Halo, saya ingin bertanya mengenai produk PT. Mega Komposit Indonesia.') }}"
               target="_blank" rel="noopener"
               class="btn-wa-main">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Chat via WhatsApp
            </a>

            <div class="map-wrap">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.500808363296!2d106.67778067586936!3d-6.329092861930787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e50d7f0a62c9%3A0x471141ad8c8c6eb4!2sPT.%20MEGA%20KOMPOSIT%20INDONESIA!5e0!3m2!1sen!2sid!4v1744523777720!5m2!1sen!2sid"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Peta lokasi PT. Mega Komposit Indonesia">
                </iframe>
            </div>

        </div>

        <div class="contact-form-wrap">

            <h3 class="form-heading">Kirim Pesan</h3>
            <p class="form-sub">Isi formulir di bawah dan kami akan menghubungi Anda secepatnya.</p>

            @if(session('mail_success'))
                <div class="form-alert success">
                    ✓ Pesan Anda berhasil dikirim. Tim kami akan segera menghubungi Anda.
                </div>
            @endif
            @if(session('mail_error'))
                <div class="form-alert error">
                    ✗ Gagal mengirim pesan. Silakan coba lagi atau hubungi kami via WhatsApp.
                </div>
            @endif

            @if ($errors->has('message'))
                <div class="form-alert error">
                    {{ $errors->first('message') }}
                </div>
            @endif

            <form action="{{ route('contact.send') }}" method="POST" id="contactForm">
                @csrf

                {{-- ── HONEYPOT: disembunyikan via CSS, bot mengisi = spam ── --}}
                <div style="display:none !important; position:absolute; left:-9999px;" aria-hidden="true">
                    <input type="text" name="website" value="" tabindex="-1" autocomplete="off">
                </div>

                {{-- ── TIME CHECK: timestamp saat halaman dibuka ────────────── --}}
                <input type="hidden" name="form_loaded_at" id="formLoadedAt" value="">

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="contact_name">Nama Lengkap <span style="color:#c8a96e">*</span></label>
                        <input type="text" id="contact_name" name="name"
                               value="{{ old('name') }}"
                               placeholder="Budi Santoso"
                               required
                               class="form-input @error('name') border-red-400 @enderror">
                        @error('name') <p style="color:#dc2626;font-size:.75rem;margin-top:4px">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="contact_phone">No. Telepon</label>
                        <input type="tel" id="contact_phone" name="phone"
                               value="{{ old('phone') }}"
                               placeholder="+62 812-0000-0000"
                               class="form-input">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="contact_email">Alamat Email <span style="color:#c8a96e">*</span></label>
                    <input type="email" id="contact_email" name="email"
                           value="{{ old('email') }}"
                           placeholder="budi@perusahaan.com"
                           required
                           class="form-input @error('email') border-red-400 @enderror">
                    @error('email') <p style="color:#dc2626;font-size:.75rem;margin-top:4px">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="contact_subject">Keperluan</label>
                    <select id="contact_subject" name="subject" class="form-select">
                        <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Pilih keperluan...</option>
                        <option value="Permintaan Penawaran"     {{ old('subject') === 'Permintaan Penawaran' ? 'selected' : '' }}>Permintaan Penawaran</option>
                        <option value="Informasi Produk"         {{ old('subject') === 'Informasi Produk' ? 'selected' : '' }}>Informasi Produk</option>
                        <option value="Kerjasama / Distributor"  {{ old('subject') === 'Kerjasama / Distributor' ? 'selected' : '' }}>Kerjasama / Distributor</option>
                        <option value="Pertanyaan Umum"          {{ old('subject') === 'Pertanyaan Umum' ? 'selected' : '' }}>Pertanyaan Umum</option>
                        <option value="Lainnya"                  {{ old('subject') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="contact_message">Pesan <span style="color:#c8a96e">*</span></label>
                    <textarea id="contact_message" name="message"
                              placeholder="Tuliskan pesan atau pertanyaan Anda di sini..."
                              required
                              class="form-textarea @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
                    @error('message') <p style="color:#dc2626;font-size:.75rem;margin-top:4px">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    Kirim Pesan
                </button>

                <p style="font-size:.72rem;color:var(--muted);text-align:center;margin-top:14px;line-height:1.6">
                    Dengan mengirim pesan, Anda setuju untuk dihubungi oleh tim kami.
                </p>
            </form>
        </div>

    </div>
</div>

<script>
document.getElementById('formLoadedAt').value = Math.floor(Date.now() / 1000);

document.getElementById('contactForm').addEventListener('submit', function () {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.textContent = 'Mengirim...';
});
</script>

@endsection
