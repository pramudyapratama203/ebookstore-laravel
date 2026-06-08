<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sign In E-Bookstore')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Literata:wght@400;600;700&family=Source+Serif+4:wght@400;600;700&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
        .animate-shimmer { background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent); background-size: 200% 100%; animation: shimmer 3s infinite; }
    </style>
</head>
<body class="min-h-screen font-['IBM_Plex_Sans'] antialiased" style="background: linear-gradient(135deg, #0f0e0b 0%, #1a1410 30%, #2d1f15 60%, #1a1410 100%);">
    
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full opacity-10" style="background: radial-gradient(circle, #c8a96e 0%, transparent 70%);"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 rounded-full opacity-10" style="background: radial-gradient(circle, #7a4f37 0%, transparent 70%);"></div>
        <div class="absolute top-1/3 left-1/4 w-64 h-64 rounded-full opacity-5 animate-float" style="background: radial-gradient(circle, #c8a96e 0%, transparent 70%);"></div>
    </div>

    <main class="relative z-10">
        @yield('content')
    </main>

</body>
</html>