<div class="attr-row flex items-center gap-2" data-idx="{{ $i }}">

    <input type="text" name="attributes[{{ $i }}][key]"
           value="{{ $attr['key'] ?? '' }}"
           placeholder="Label (Contoh: Ukuran)"
           class="attr-key w-[30%] bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">

    <input type="text" name="attributes[{{ $i }}][value]"
           value="{{ $attr['value'] ?? '' }}"
           placeholder="Nilai (Contoh: XL)"
           class="attr-val flex-1 bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600 focus:outline-none focus:border-violet-500 focus:ring-1 focus:ring-violet-500 transition-colors">

    <button type="button"
            class="remove-attr w-7 h-7 flex items-center justify-center text-gray-600 hover:text-red-400 shrink-0 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

</div>
