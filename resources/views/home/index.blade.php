@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!-- HERO TOP -->
<div class="relative w-full h-[80vh] bg-cover bg-center flex items-end pb-48"
     style="background-image: url('/img/bg.png');">

    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative z-10 px-8 md:px-20 text-white max-w-3xl">

        <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">
            Pusat Grosir MKI
        </h1>

        <p class="text-lg md:text-2xl leading-relaxed">
            Solusi Kuat, Elegan, dan Tahan Lama untuk Setiap Kebutuhan.
        </p>

    </div>

</div>

<!-- CONTENT BAWAH (bebas isi apa aja) -->
<div class="py-16 px-8 md:px-20 bg-white">
    <h2 class="text-2xl font-semibold mb-4">Konten Lain</h2>
    <p class="text-gray-600">Isi halaman selanjutnya di sini...</p>
</div>

@endsection
