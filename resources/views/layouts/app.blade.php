<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyStore')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-transparent">

    <x-header />

    <main class="flex-1 pt-16">
        @yield('content')
    </main>

    <x-footer />

<style>

#wa-fab {
    position: fixed;
    bottom: 28px;
    right: 28px;
    z-index: 900;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 10px;
    opacity: 0;
    transform: translateY(16px);
    animation: waFabIn 0.45s cubic-bezier(0.34, 1.56, 0.64, 1) 1.5s forwards;
}

@keyframes waFabIn {
    to { opacity: 1; transform: translateY(0); }
}

#wa-tooltip {
    background: #1a1612;
    color: #f0ebe3;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.78rem;
    font-weight: 400;
    line-height: 1.45;
    padding: 10px 14px;
    border-radius: 10px 10px 2px 10px;
    white-space: nowrap;
    box-shadow: 0 6px 24px rgba(0,0,0,0.22);
    pointer-events: none;

    opacity: 0;
    transform: translateX(8px) scale(0.95);
    transform-origin: bottom right;
    transition: opacity 0.22s ease, transform 0.22s cubic-bezier(0.34,1.4,0.64,1);
}
#wa-tooltip.visible {
    opacity: 1;
    transform: translateX(0) scale(1);
    pointer-events: auto;
}
#wa-tooltip strong {
    display: block;
    color: #25D366;
    font-weight: 500;
    margin-bottom: 1px;
}

#wa-btn {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: #25D366;
    color: #fff;
    text-decoration: none;
    box-shadow:
        0 4px 16px rgba(37, 211, 102, 0.45),
        0 2px 6px  rgba(0, 0, 0, 0.15);
    transition:
        transform  0.2s cubic-bezier(0.34,1.56,0.64,1),
        box-shadow 0.2s ease,
        background 0.2s ease;
    flex-shrink: 0;
}
#wa-btn:hover {
    background: #20ba5a;
    transform: scale(1.1);
    box-shadow:
        0 6px 24px rgba(37, 211, 102, 0.55),
        0 3px 8px  rgba(0, 0, 0, 0.18);
}
#wa-btn:active {
    transform: scale(0.96);
}
#wa-btn svg {
    width: 28px;
    height: 28px;
    flex-shrink: 0;
}

#wa-btn::before {
    content: '';
    position: absolute;
    inset: -4px;
    border-radius: 50%;
    border: 2px solid #25D366;
    opacity: 0;
    animation: waPulse 2.8s ease-out 3s infinite;
}
@keyframes waPulse {
    0%   { opacity: 0.6; transform: scale(1); }
    100% { opacity: 0;   transform: scale(1.55); }
}

#wa-dot {
    position: absolute;
    top: 3px;
    right: 3px;
    width: 12px;
    height: 12px;
    background: #fff;
    border: 2px solid #25D366;
    border-radius: 50%;
    animation: waDotPop 0.35s cubic-bezier(0.34,1.56,0.64,1) 2.2s both;
}
#wa-dot::after {
    content: '';
    position: absolute;
    inset: 2px;
    background: #ff4d4f;
    border-radius: 50%;
}
@keyframes waDotPop {
    from { transform: scale(0); }
    to   { transform: scale(1); }
}

body.is-admin #wa-fab { display: none; }
</style>

<div id="wa-fab">
    <div id="wa-tooltip" role="tooltip">
        <strong>Ada yang bisa kami bantu?</strong>
        Chat langsung via WhatsApp
    </div>

    <a id="wa-btn"
       href="https://wa.me/6281112016231?text={{ urlencode('Halo, saya ingin bertanya mengenai produk PT. Mega Komposit Indonesia.') }}"
       target="_blank"
       rel="noopener noreferrer"
       aria-label="Chat via WhatsApp"
       title="Hubungi kami via WhatsApp">

        <span id="wa-dot" aria-hidden="true"></span>

        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>
</div>

<script>
(function () {
    const btn     = document.getElementById('wa-btn');
    const tooltip = document.getElementById('wa-tooltip');
    const dot     = document.getElementById('wa-dot');
    if (!btn || !tooltip) return;

    btn.addEventListener('mouseenter', () => tooltip.classList.add('visible'));
    btn.addEventListener('mouseleave', () => tooltip.classList.remove('visible'));
    btn.addEventListener('focus',      () => tooltip.classList.add('visible'));
    btn.addEventListener('blur',       () => tooltip.classList.remove('visible'));

    const shown = sessionStorage.getItem('wa_tooltip_shown');
    if (!shown) {
        setTimeout(() => {
            tooltip.classList.add('visible');
            setTimeout(() => tooltip.classList.remove('visible'), 3800);
            sessionStorage.setItem('wa_tooltip_shown', '1');
        }, 4000);
    }

    btn.addEventListener('click', () => {
        if (dot) {
            dot.style.transition = 'transform 0.2s ease, opacity 0.2s ease';
            dot.style.transform  = 'scale(0)';
            dot.style.opacity    = '0';
        }
        sessionStorage.setItem('wa_dot_dismissed', '1');
    });

    if (sessionStorage.getItem('wa_dot_dismissed') && dot) {
        dot.style.display = 'none';
    }
})();
</script>

</body>
</html>
