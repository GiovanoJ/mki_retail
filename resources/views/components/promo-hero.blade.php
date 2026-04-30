@props(['promos'])

<style>
.hero-section {
    padding: 48px 24px 40px;
    background: #f7f5f2;
}
.hero-card {
    max-width: 1280px;
    margin: 0 auto;
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    height: clamp(260px, 38vw, 480px);
    box-shadow: 0 8px 40px rgba(0,0,0,0.18), 0 2px 8px rgba(0,0,0,0.08);
    background: #1a1612;
    transition: transform 0.35s ease, box-shadow 0.35s ease;
}

.hero-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 18px 55px rgba(0,0,0,0.24), 0 8px 18px rgba(0,0,0,0.12);
}

.hero-slide {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    opacity: 0;
    transition: opacity 0.7s ease;
    pointer-events: none;
}
.hero-slide.active {
    opacity: 1;
    pointer-events: auto;
}

.hero-card > img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.hero-caption {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 48px 40px 36px;
    background: linear-gradient(to top, rgba(0,0,0,0.65) 0%, transparent 100%);
}
.hero-caption-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(1.4rem, 3vw, 2.2rem);
    font-weight: 400;
    color: #f0ebe3;
    letter-spacing: -0.01em;
    line-height: 1.15;
    margin-bottom: 6px;
}
.hero-caption-sub {
    font-size: 0.88rem;
    color: rgba(240,235,227,0.8);
    font-weight: 300;
    letter-spacing: 0.02em;
}

.hero-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.25);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    backdrop-filter: blur(6px);
    transition: background 0.2s, transform 0.2s;
    z-index: 10;
    outline: none;
}
.hero-arrow:hover {
    background: rgba(255,255,255,0.28);
    transform: translateY(-50%) scale(1.08);
}
.hero-arrow-left  { left: 18px; }
.hero-arrow-right { right: 18px; }

.hero-dots {
    position: absolute;
    bottom: 18px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
}
.hero-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255,255,255,0.4);
    border: none;
    cursor: pointer;
    padding: 0;
    transition: background 0.25s, transform 0.25s;
    outline: none;
}
.hero-dot.active {
    background: #fff;
    transform: scale(1.3);
}
</style>

@if($promos->isEmpty())
    <div class="hero-section">
        <div class="hero-card">
            <img src="{{ asset('img/card1.webp') }}" alt="Material Bangunan Premium">
        </div>
    </div>
@else
    <div class="hero-section">
        <div class="hero-card" id="heroCarousel">

            @foreach($promos as $i => $promo)
                <div class="hero-slide {{ $i === 0 ? 'active' : '' }}"
                     data-index="{{ $i }}"
                     style="background-image: url('{{ asset('storage/' . $promo->image_path) }}')">
                </div>
            @endforeach

            @if($promos->count() > 1)
                <button class="hero-arrow hero-arrow-left" id="heroPrev" aria-label="Sebelumnya">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="hero-arrow hero-arrow-right" id="heroNext" aria-label="Berikutnya">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div class="hero-dots">
                    @foreach($promos as $i => $promo)
                        <button class="hero-dot {{ $i === 0 ? 'active' : '' }}"
                                data-index="{{ $i }}"
                                aria-label="Slide {{ $i + 1 }}"></button>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

    <script>
    (function () {
        const carousel = document.getElementById('heroCarousel');
        if (!carousel) return;

        const slides  = carousel.querySelectorAll('.hero-slide');
        const dots    = carousel.querySelectorAll('.hero-dot');
        const prevBtn = document.getElementById('heroPrev');
        const nextBtn = document.getElementById('heroNext');
        const total   = slides.length;
        if (total <= 1) return;

        let current = 0;
        let timer   = null;

        function goTo(idx) {
            slides[current].classList.remove('active');
            if (dots[current]) dots[current].classList.remove('active');
            current = (idx + total) % total;
            slides[current].classList.add('active');
            if (dots[current]) dots[current].classList.add('active');
        }

        function next() { goTo(current + 1); }
        function prev() { goTo(current - 1); }

        function startTimer() {
            clearInterval(timer);
            timer = setInterval(next, 7000);
        }

        if (prevBtn) prevBtn.addEventListener('click', () => { prev(); startTimer(); });
        if (nextBtn) nextBtn.addEventListener('click', () => { next(); startTimer(); });

        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                goTo(parseInt(dot.dataset.index));
                startTimer();
            });
        });

        carousel.addEventListener('mouseenter', () => clearInterval(timer));
        carousel.addEventListener('mouseleave', startTimer);

        let touchStartX = 0;
        carousel.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].clientX;
        }, { passive: true });
        carousel.addEventListener('touchend', e => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 40) {
                diff > 0 ? next() : prev();
                startTimer();
            }
        }, { passive: true });

        startTimer();
    })();
    </script>
@endif

