<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BookStore — Baca Tanpa Batas</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Literata:wght@400;600;700&family=Source+Serif+4:wght@400;600;700&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-18px); }
        }
        @keyframes float2 {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }
        @keyframes float3 {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-22px); }
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
        .animate-float2 { animation: float2 7s ease-in-out infinite 1s; }
        .animate-float3 { animation: float3 5s ease-in-out infinite 0.5s; }
        .animate-fade-in-up { animation: fadeInUp 0.7s ease-out forwards; opacity: 0; }
        .fade-delay-1 { animation-delay: 0.1s; }
        .fade-delay-2 { animation-delay: 0.2s; }
        .fade-delay-3 { animation-delay: 0.3s; }
        .fade-delay-4 { animation-delay: 0.4s; }
        .fade-delay-5 { animation-delay: 0.5s; }
        .animate-shimmer { background: linear-gradient(90deg, transparent, rgba(200,169,110,0.1), transparent); background-size: 200% 100%; animation: shimmer 3s infinite; }

        html { scroll-behavior: smooth; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0f0e0b; }
        ::-webkit-scrollbar-thumb { background: rgba(200,169,110,0.3); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(200,169,110,0.5); }

        .grain {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
        }
    </style>
</head>
<body class="min-h-screen font-['IBM_Plex_Sans'] antialiased bg-[#0f0e0b]">

    <!-- Grain Overlay -->
    <div class="grain fixed inset-0 z-50 pointer-events-none"></div>

    <!-- Ambient Glow Orbs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full opacity-15" style="background: radial-gradient(circle, #c8a96e 0%, transparent 70%);"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 rounded-full opacity-10" style="background: radial-gradient(circle, #7a4f37 0%, transparent 70%);"></div>
        <div class="absolute top-1/4 left-1/3 w-72 h-72 rounded-full opacity-5 animate-float" style="background: radial-gradient(circle, #c8a96e 0%, transparent 70%);"></div>
        <div class="absolute bottom-1/3 right-1/4 w-96 h-96 rounded-full opacity-5 animate-float2" style="background: radial-gradient(circle, #a07840 0%, transparent 70%);"></div>
    </div>

    <!-- NAVBAR -->
    <nav class="fixed top-0 left-0 right-0 z-40" style="background: rgba(15, 14, 11, 0.85); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.06);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(200,169,110,0.2), rgba(160,120,64,0.1)); border: 1px solid rgba(200,169,110,0.3);">
                        <span class="material-symbols-outlined text-[#c8a96e] text-lg">auto_stories</span>
                    </div>
                    <span class="font-['Literata'] text-lg sm:text-xl font-bold text-white">E-BookStore</span>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-semibold text-[#e8e0d0] rounded-xl transition-all hover:bg-white/5" style="border: 1px solid rgba(255,255,255,0.1);">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-bold text-[#0a0800] rounded-xl transition-all hover:shadow-lg" style="background: linear-gradient(135deg, #c8a96e, #a07840);">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="relative pt-32 sm:pt-40 pb-20 sm:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                <!-- Left: Text -->
                <div class="text-center lg:text-left">
                    <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-6 animate-fade-in-up fade-delay-1" style="background: rgba(200,169,110,0.12); color: #c8a96e; border: 1px solid rgba(200,169,110,0.2);">
                        Platform E-Book Premium
                    </span>
                    <h1 class="font-['Literata'] text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6 animate-fade-in-up fade-delay-2">
                        Baca Tanpa<br>
                        <span style="background: linear-gradient(135deg, #c8a96e, #e8d5a3); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Batas</span>
                        <span class="text-[#c8a96e]">.</span>
                    </h1>
                    <p class="text-base sm:text-lg text-[#a09880] max-w-lg mx-auto lg:mx-0 leading-relaxed mb-8 animate-fade-in-up fade-delay-3">
                        Ribuan koleksi ebook terbaik dari penulis terkemuka. Nikmati pengalaman membaca digital yang nyaman, kapan saja dan di mana saja.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start animate-fade-in-up fade-delay-4">
                        <a href="{{ route('register') }}" class="px-8 py-3.5 text-sm font-bold uppercase tracking-widest rounded-xl text-[#0a0800] transition-all hover:shadow-xl active:scale-[0.98]" style="background: linear-gradient(135deg, #c8a96e, #a07840);">
                            Mulai Membaca
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-3.5 text-sm font-semibold text-[#e8e0d0] rounded-xl transition-all hover:bg-white/5 active:scale-[0.98]" style="border: 1px solid rgba(255,255,255,0.12);">
                            Saya Sudah Punya Akun
                        </a>
                    </div>
                </div>

                <!-- Right: Floating Books -->
                <div class="hidden lg:block relative h-[500px] animate-fade-in-up fade-delay-5">
                    <div class="absolute w-44 h-60 rounded-2xl overflow-hidden shadow-2xl animate-float" style="top: 20px; left: 40px; transform: rotate(-6deg); background: linear-gradient(145deg, #5f3822, #7a4f37);">
                        <div class="absolute left-0 top-0 bottom-0 w-3 bg-black/30"></div>
                        <div class="p-5 flex flex-col justify-end h-full">
                            <div class="text-xs text-white/60 uppercase tracking-wider mb-1">Fiksi</div>
                            <div class="font-['Literata'] text-sm font-bold text-white leading-tight">The Silent Echo</div>
                            <div class="text-xs text-white/50 mt-1">Clara B. Winter</div>
                        </div>
                    </div>
                    <div class="absolute w-40 h-56 rounded-2xl overflow-hidden shadow-2xl animate-float2" style="top: 0px; right: 60px; transform: rotate(4deg); background: linear-gradient(145deg, #1a3a4a, #2a5a6a);">
                        <div class="absolute left-0 top-0 bottom-0 w-3 bg-black/30"></div>
                        <div class="p-5 flex flex-col justify-end h-full">
                            <div class="text-xs text-white/60 uppercase tracking-wider mb-1">Sains</div>
                            <div class="font-['Literata'] text-sm font-bold text-white leading-tight">Quantum Realm</div>
                            <div class="text-xs text-white/50 mt-1">Dr. M. Feynman</div>
                        </div>
                    </div>
                    <div class="absolute w-44 h-60 rounded-2xl overflow-hidden shadow-2xl animate-float3" style="bottom: 30px; left: 100px; transform: rotate(3deg); background: linear-gradient(145deg, #3d2a1a, #5f3a22);">
                        <div class="absolute left-0 top-0 bottom-0 w-3 bg-black/30"></div>
                        <div class="p-5 flex flex-col justify-end h-full">
                            <div class="text-xs text-white/60 uppercase tracking-wider mb-1">Sejarah</div>
                            <div class="font-['Literata'] text-sm font-bold text-white leading-tight">Lost Kingdoms</div>
                            <div class="text-xs text-white/50 mt-1">A. Harvani</div>
                        </div>
                    </div>
                    <div class="absolute w-36 h-48 rounded-2xl overflow-hidden shadow-2xl animate-float2" style="bottom: 60px; right: 30px; transform: rotate(-4deg); background: linear-gradient(145deg, #2d1f15, #4a3020);">
                        <div class="absolute left-0 top-0 bottom-0 w-3 bg-black/30"></div>
                        <div class="p-4 flex flex-col justify-end h-full">
                            <div class="text-[10px] text-white/60 uppercase tracking-wider mb-1">Teknologi</div>
                            <div class="font-['Literata'] text-xs font-bold text-white leading-tight">Code & Silicon</div>
                            <div class="text-[10px] text-white/50 mt-1">R. Tanuwijaya</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="py-20 sm:py-28 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-4" style="background: rgba(200,169,110,0.12); color: #c8a96e; border: 1px solid rgba(200,169,110,0.2);">
                    Kenapa Kami?
                </span>
                <h2 class="font-['Literata'] text-3xl sm:text-4xl font-bold text-white mb-4">
                    Nikmati Pengalaman Membaca<br>yang Berbeda
                </h2>
                <p class="text-[#a09880] max-w-2xl mx-auto">
                    Platform yang dirancang untuk kenyamanan membaca digital dengan koleksi ebook berkualitas.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="p-6 sm:p-8 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center mx-auto mb-5" style="background: rgba(200,169,110,0.12); border: 1px solid rgba(200,169,110,0.2);">
                        <span class="material-symbols-outlined text-[#c8a96e] text-2xl">auto_stories</span>
                    </div>
                    <h3 class="font-['Literata'] text-lg font-bold text-white mb-2">Ribuan Koleksi</h3>
                    <p class="text-sm text-[#a09880] leading-relaxed">Akses ke ribuan ebook dari berbagai genre dan kategori, dari penulis lokal hingga internasional.</p>
                </div>

                <div class="p-6 sm:p-8 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center mx-auto mb-5" style="background: rgba(200,169,110,0.12); border: 1px solid rgba(200,169,110,0.2);">
                        <span class="material-symbols-outlined text-[#c8a96e] text-2xl">devices</span>
                    </div>
                    <h3 class="font-['Literata'] text-lg font-bold text-white mb-2">Multi-Perangkat</h3>
                    <p class="text-sm text-[#a09880] leading-relaxed">Baca di mana saja, kapan saja. Sinkronisasi otomatis di semua perangkat Anda.</p>
                </div>

                <div class="p-6 sm:p-8 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center mx-auto mb-5" style="background: rgba(200,169,110,0.12); border: 1px solid rgba(200,169,110,0.2);">
                        <span class="material-symbols-outlined text-[#c8a96e] text-2xl">verified</span>
                    </div>
                    <h3 class="font-['Literata'] text-lg font-bold text-white mb-2">Koleksi Premium</h3>
                    <p class="text-sm text-[#a09880] leading-relaxed">Ebook berkualitas tinggi dengan kurasi ketat dari tim editorial kami.</p>
                </div>

                <div class="p-6 sm:p-8 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center mx-auto mb-5" style="background: rgba(200,169,110,0.12); border: 1px solid rgba(200,169,110,0.2);">
                        <span class="material-symbols-outlined text-[#c8a96e] text-2xl">sell</span>
                    </div>
                    <h3 class="font-['Literata'] text-lg font-bold text-white mb-2">Jual Karya Sendiri</h3>
                    <p class="text-sm text-[#a09880] leading-relaxed">Penulis dapat menerbitkan dan menjual ebook langsung di platform kami.</p>
                </div>

                <div class="p-6 sm:p-8 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center mx-auto mb-5" style="background: rgba(200,169,110,0.12); border: 1px solid rgba(200,169,110,0.2);">
                        <span class="material-symbols-outlined text-[#c8a96e] text-2xl">star</span>
                    </div>
                    <h3 class="font-['Literata'] text-lg font-bold text-white mb-2">Rating & Ulasan</h3>
                    <p class="text-sm text-[#a09880] leading-relaxed">Temukan buku terbaik berdasarkan rating dan ulasan dari pembaca lain.</p>
                </div>

                <div class="p-6 sm:p-8 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center mx-auto mb-5" style="background: rgba(200,169,110,0.12); border: 1px solid rgba(200,169,110,0.2);">
                        <span class="material-symbols-outlined text-[#c8a96e] text-2xl">security</span>
                    </div>
                    <h3 class="font-['Literata'] text-lg font-bold text-white mb-2">Transaksi Aman</h3>
                    <p class="text-sm text-[#a09880] leading-relaxed">Sistem pembayaran yang aman dan terpercaya untuk setiap transaksi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CATEGORIES -->
    <section class="py-20 sm:py-28 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-4" style="background: rgba(200,169,110,0.12); color: #c8a96e; border: 1px solid rgba(200,169,110,0.2);">
                    Jelajahi
                </span>
                <h2 class="font-['Literata'] text-3xl sm:text-4xl font-bold text-white mb-4">
                    Kategori Populer
                </h2>
                <p class="text-[#a09880] max-w-2xl mx-auto">
                    Temukan ribuan buku dalam berbagai kategori yang sesuai dengan minat Anda.
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                <div class="p-6 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1 cursor-pointer" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);" onclick="window.location='{{ route('register') }}'">
                    <span class="material-symbols-outlined text-3xl text-[#c8a96e] mb-3 block">auto_stories</span>
                    <span class="text-sm font-semibold text-white">Fiksi</span>
                </div>
                <div class="p-6 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1 cursor-pointer" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);" onclick="window.location='{{ route('register') }}'">
                    <span class="material-symbols-outlined text-3xl text-[#c8a96e] mb-3 block">science</span>
                    <span class="text-sm font-semibold text-white">Sains</span>
                </div>
                <div class="p-6 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1 cursor-pointer" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);" onclick="window.location='{{ route('register') }}'">
                    <span class="material-symbols-outlined text-3xl text-[#c8a96e] mb-3 block">history</span>
                    <span class="text-sm font-semibold text-white">Sejarah</span>
                </div>
                <div class="p-6 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1 cursor-pointer" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);" onclick="window.location='{{ route('register') }}'">
                    <span class="material-symbols-outlined text-3xl text-[#c8a96e] mb-3 block">terminal</span>
                    <span class="text-sm font-semibold text-white">Teknologi</span>
                </div>
                <div class="p-6 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1 cursor-pointer" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);" onclick="window.location='{{ route('register') }}'">
                    <span class="material-symbols-outlined text-3xl text-[#c8a96e] mb-3 block">psychology</span>
                    <span class="text-sm font-semibold text-white">Psikologi</span>
                </div>
                <div class="p-6 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1 cursor-pointer" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06);" onclick="window.location='{{ route('register') }}'">
                    <span class="material-symbols-outlined text-3xl text-[#c8a96e] mb-3 block">business</span>
                    <span class="text-sm font-semibold text-white">Bisnis</span>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 sm:py-28 relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="p-10 sm:p-16 rounded-3xl relative overflow-hidden" style="background: radial-gradient(ellipse 70% 50% at 50% 50%, rgba(200,169,110,0.06) 0%, transparent 70%), rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06);">
                <div class="absolute -top-20 -right-20 w-60 h-60 rounded-full opacity-10" style="background: radial-gradient(circle, #c8a96e 0%, transparent 70%);"></div>
                <div class="relative z-10">
                    <h2 class="font-['Literata'] text-3xl sm:text-4xl font-bold text-white mb-4">
                        Siap Memulai Petualangan<br>Membaca Anda?
                    </h2>
                    <p class="text-[#a09880] max-w-lg mx-auto mb-8">
                        Daftar sekarang dan dapatkan akses ke ribuan koleksi ebook berkualitas. Mulai perjalanan literasi digital Anda hari ini.
                    </p>
                    <a href="{{ route('register') }}" class="inline-block px-10 py-3.5 text-sm font-bold uppercase tracking-widest rounded-xl text-[#0a0800] transition-all hover:shadow-xl active:scale-[0.98]" style="background: linear-gradient(135deg, #c8a96e, #a07840);">
                        Daftar Gratis
                    </a>
                    <p class="text-xs text-[#a09880] mt-4">Sudah punya akun? <a href="{{ route('login') }}" class="text-[#c8a96e] hover:underline">Masuk di sini</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="border-t border-white/5 py-10" style="background: #0a0908;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, rgba(200,169,110,0.2), rgba(160,120,64,0.1)); border: 1px solid rgba(200,169,110,0.3);">
                        <span class="material-symbols-outlined text-[#c8a96e] text-sm">auto_stories</span>
                    </div>
                    <span class="font-['Literata'] text-base font-bold text-white">E-BookStore</span>
                </div>
                <p class="text-xs text-[#a09880]">&copy; {{ date('Y') }} E-BookStore. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
