<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-BookStore')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Literata:wght@400;600;700&family=Source+Serif+4:wght@400;600;700&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<body class="font-body-md text-on-surface bg-[#fcf9f0]">
    @include('layouts.partials.seller.navbar')
    
    <main>
        @yield('content')
    </main>
    
    @include('layouts.partials.seller.footer')
    
    @stack('scripts')
</body>
</html>