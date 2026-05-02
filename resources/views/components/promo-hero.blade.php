@props(['promos'])

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

