<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Auth') — MyStore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 min-h-screen flex items-center justify-center p-4 font-sans antialiased">

    <div class="w-full max-w-md">

        <div class="flex items-center justify-center gap-2.5 mb-8">
            <div class="w-8 h-8 bg-violet-600 rounded-xl flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                </svg>
            </div>
            <span class="text-white font-semibold text-lg">MyStore Admin</span>
        </div>

        <div class="bg-gray-900 rounded-2xl border border-gray-800 p-7">
            @yield('content')
        </div>
    </div>

</body>
</html>
