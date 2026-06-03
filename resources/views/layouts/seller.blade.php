<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-BookStore')</title>
    @vite(['resources/css/app.css', 'resources/css/style.css'])
</head>
<body class="bg-[#0f0e0b] text-[#e8e0d0]">
    @include('layouts.partials.seller.navbar')
    
    <main>
        @yield('content')
    </main>
    
    @include('layouts.partials.seller.footer')
    
    @vite('resources/js/app.js')
</body>
</html>