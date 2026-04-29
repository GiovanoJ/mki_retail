<header class="bg-[#f1de6d] backdrop-blur-xl fixed top-0 left-0 w-full z-50 border-b border-white/20">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-content-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                </svg>
            </div>
            <span class="text-lg font-medium text-gray-900">Pusat Grosir MKI</span>
        </a>

        <nav class="flex items-center gap-1">
            {{-- <a href="{{ route('home') }}"
               class="px-4 py-1.5 text-sm rounded-lg transition-colors
                      {{ request()->routeIs('home') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-black hover:bg-gray-100 hover:text-gray-800' }}">
                Home
            </a> --}}
            <a href="{{ route('products.index') }}"
               class="px-4 py-1.5 text-sm rounded-lg transition-colors
                      {{ request()->routeIs('products.*') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-black hover:bg-gray-100 hover:text-gray-800' }}">
                Produk
            </a>
            <a href="{{ route('contact') }}"
               class="px-4 py-1.5 text-sm rounded-lg transition-colors
                      {{ request()->routeIs('contact') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-black hover:bg-gray-100 hover:text-gray-800' }}">
                Contact
            </a>
        </nav>

    </div>
</header>
