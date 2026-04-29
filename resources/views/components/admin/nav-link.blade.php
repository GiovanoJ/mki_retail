@props(['href', 'active' => false, 'icon' => 'circle'])

@php
$icons = [
    'grid' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>',
    'package' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>',
    'circle' => '<circle cx="12" cy="12" r="10"/>',
];
$svgPath = $icons[$icon] ?? $icons['circle'];
@endphp

<a href="{{ $href }}"
   class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-medium transition-colors
          {{ $active
              ? 'bg-violet-600/20 text-violet-300 border border-violet-500/30'
              : 'text-gray-400 hover:text-gray-200 hover:bg-gray-800 border border-transparent' }}">
    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        {!! $svgPath !!}
    </svg>
    {{ $slot }}
</a>
