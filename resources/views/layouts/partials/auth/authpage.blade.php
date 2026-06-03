<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sign In E-Bookstore')</title>
    @vite(['resources/css/app.css', 'resources/css/style.css'])
</head>
<body class="bg-[#0f0e0b] text-[#e8e0d0]">
    
    <main>
        @yield('content')
    </main>
    
    
    @vite('resources/js/app.js')
</body>
</html>