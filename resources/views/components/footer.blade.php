<footer class="bg-[#f1de6d] border-t border-gray-100 mt-auto">
    <div class="max-w-7xl mx-auto px-6 pt-10 pb-6">

        <div class="grid grid-cols-3 gap-8 mb-8">
            <div>
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-3">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                        </svg>
                    </div>
                    <span class="text-lg font-medium text-gray-900">Pusat Grosir MKI</span>
                </a>
                <p class="text-sm text-gray-600 leading-relaxed max-w-xs">
                    Temukan produk terbaik dengan harga terjangkau. Kami hadir untuk memenuhi kebutuhan Anda sehari-hari.
                </p>
            </div>

            <div>
                <h4 class="text-sm font-medium text-gray-800 mb-3">Navigasi</h4>
                <ul class="space-y-2">
                    {{-- <li><a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">Home</a></li> --}}
                    <li><a href="{{ route('Products.index') }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">Produk</a></li>
                    <li><a href="{{ route('contact') }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-medium text-gray-800 mb-3">Hubungi Kami</h4>
                <ul class="space-y-2">
                    <li><a href="mailto:info@mystore.com" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">info@mystore.com</a></li>
                    <li><span class="text-sm text-gray-600">+62 811 1201 6231</span></li>
                    <li><span class="text-sm text-gray-600">Jl. Joglo Raya No.21, RT.12/RW.1, Joglo, Kec. Kembangan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11640</span></li>
                </ul>
            </div>

        </div>

        <div class="border-t border-gray-200 pt-5 flex items-center justify-between">
            <p class="text-xs text-gray-400">&copy; {{ date('Y') }} Pusat Grosir MKI. Semua hak dilindungi.</p>
            <div class="flex gap-2">
                <a href="#" class="w-7 h-7 rounded-lg border border-gray-200 bg-white flex items-center justify-center hover:bg-gray-50 transition-colors">
                    <svg class="w-3.5 h-3.5 text-gray-500" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                </a>
                <a href="#" class="w-7 h-7 rounded-lg border border-gray-200 bg-white flex items-center justify-center hover:bg-gray-50 transition-colors">
                    <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><circle cx="17.5" cy="6.5" r=".5" fill="currentColor"/></svg>
                </a>
                <a href="#" class="w-7 h-7 rounded-lg border border-gray-200 bg-white flex items-center justify-center hover:bg-gray-50 transition-colors">
                    <svg class="w-3.5 h-3.5 text-gray-500" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
                </a>
            </div>
        </div>

    </div>
</footer>
