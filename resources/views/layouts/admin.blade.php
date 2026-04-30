<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — MyStore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen font-sans antialiased">

    <div class="flex min-h-screen">

        <aside class="w-60 bg-gray-900 border-r border-gray-800 flex flex-col shrink-0">

            <div class="h-16 flex items-center gap-3 px-5 border-b border-gray-800">
                <div class="w-7 h-7 bg-violet-600 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-white leading-tight">MyStore</p>
                    <p class="text-[10px] text-gray-500 leading-tight">Admin Panel</p>
                </div>
            </div>

            <nav class="flex-1 p-3 space-y-0.5">
                <x-admin.nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" icon="grid">
                    Dashboard
                </x-admin.nav-link>
                <x-admin.nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')" icon="package">
                    Produk
                </x-admin.nav-link>
                <x-admin.nav-link :href="route('admin.promos.index')" :active="request()->routeIs('admin.promos.*')" icon="image">
                    Promo
                </x-admin.nav-link>
            </nav>

            {{-- User info + logout --}}
            <div class="p-3 border-t border-gray-800">
                @php $adminUser = Auth::guard('admin')->user(); @endphp
                <div class="flex items-center gap-2.5 px-2 py-2 mb-1">
                    <div class="w-7 h-7 rounded-full bg-violet-700 flex items-center justify-center text-xs font-bold text-white shrink-0">
                        {{ strtoupper(substr($adminUser?->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-medium text-gray-200 truncate">{{ $adminUser?->name ?? 'Admin' }}</p>
                        <p class="text-[10px] text-gray-500">Administrator</p>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-2 px-3 py-2 text-xs text-gray-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main content --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Top bar --}}
            <header class="h-16 bg-gray-900 border-b border-gray-800 flex items-center justify-between px-6 shrink-0">
                <div>
                    <h1 class="text-sm font-semibold text-white">@yield('title', 'Dashboard')</h1>
                    <p class="text-xs text-gray-500">@yield('subtitle', 'Kelola toko Anda')</p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" target="_blank"
                       class="flex items-center gap-1.5 text-xs text-gray-400 hover:text-white border border-gray-700 hover:border-gray-600 px-3 py-1.5 rounded-lg transition-colors">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Lihat Toko
                    </a>
                </div>
            </header>

            {{-- Flash messages --}}
            @if (session('success'))
                <div class="mx-6 mt-4 flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs px-4 py-3 rounded-lg">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mx-6 mt-4 flex items-center gap-2 bg-red-500/10 border border-red-500/30 text-red-400 text-xs px-4 py-3 rounded-lg">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <main class="flex-1 p-6 overflow-auto">
                @yield('content')
            </main>
        </div>
    </div>

@stack('scripts')
</body>
</html>
