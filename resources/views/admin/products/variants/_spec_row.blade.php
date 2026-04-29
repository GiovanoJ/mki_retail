<div class="spec-row flex items-center gap-2">
    <input type="text" name="specs[{{ $i }}][key]"
           value="{{ $spec['key'] ?? '' }}"
           placeholder="Contoh: Berat"
           class="w-[30%] bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
    <span class="text-gray-600 text-sm">:</span>
    <input type="text" name="specs[{{ $i }}][value]"
           value="{{ $spec['value'] ?? '' }}"
           placeholder="Contoh: 250gr"
           class="flex-1 bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">
    <button type="button" onclick="this.closest('.spec-row').remove()"
            class="w-7 h-7 flex items-center justify-center text-gray-600 hover:text-red-400 shrink-0 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
</div>
