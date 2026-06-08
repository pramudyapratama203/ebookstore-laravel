@extends('layouts.partials.auth.authpage')

@section('title', 'Sign Up')

@section('content')
<div class="pt-24 pb-20 flex items-center justify-center min-h-screen px-4">
    <div class="w-full max-w-md animate-fade-in-up">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-[#c8a96e] to-[#7a4f37] shadow-lg shadow-[#c8a96e]/20 mb-6">
                <span class="material-symbols-outlined text-white text-3xl">person_add</span>
            </div>
            <h2 class="font-['Literata'] text-3xl font-bold text-white">
                Mulai Petualangan <em class="italic font-normal">Membaca</em>
            </h2>
            <p class="mt-2 text-sm text-[#a09880]">
                Buat akun baru Anda dalam hitungan menit
            </p>
        </div>

        <div class="bg-white/5 backdrop-blur-xl p-8 rounded-3xl border border-white/10 shadow-2xl">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-xs uppercase tracking-wider text-[#a09880] mb-2 font-semibold">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#a09880]">
                            <span class="material-symbols-outlined text-sm">person</span>
                        </span>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nama lengkap Anda"
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-white/10 border border-white/10 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-[#c8a96e] focus:ring-1 focus:ring-[#c8a96e]/30 transition-all">
                    </div>
                    @error('name')
                        <p class="text-red-400 text-xs mt-2 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs uppercase tracking-wider text-[#a09880] mb-2 font-semibold">Email</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#a09880]">
                            <span class="material-symbols-outlined text-sm">mail</span>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@email.com"
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-white/10 border border-white/10 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-[#c8a96e] focus:ring-1 focus:ring-[#c8a96e]/30 transition-all">
                    </div>
                    @error('email')
                        <p class="text-red-400 text-xs mt-2 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block text-xs uppercase tracking-wider text-[#a09880] mb-2 font-semibold">Mendaftar Sebagai</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#a09880]">
                            <span class="material-symbols-outlined text-sm">badge</span>
                        </span>
                        <select id="role" name="role" required 
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-white/10 border border-white/10 text-white text-sm focus:outline-none focus:border-[#c8a96e] focus:ring-1 focus:ring-[#c8a96e]/30 transition-all cursor-pointer appearance-none">
                            <option value="buyer" class="bg-[#1a1410]" {{ old('role') == 'buyer' ? 'selected' : '' }}>Pembeli (Buyer)</option>
                            <option value="seller" class="bg-[#1a1410]" {{ old('role') == 'seller' ? 'selected' : '' }}>Penjual (Seller)</option>
                        </select>
                    </div>
                    @error('role')
                        <p class="text-red-400 text-xs mt-2 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs uppercase tracking-wider text-[#a09880] mb-2 font-semibold">Password</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#a09880]">
                            <span class="material-symbols-outlined text-sm">lock</span>
                        </span>
                        <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter"
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-white/10 border border-white/10 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-[#c8a96e] focus:ring-1 focus:ring-[#c8a96e]/30 transition-all">
                    </div>
                    @error('password')
                        <p class="text-red-400 text-xs mt-2 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs uppercase tracking-wider text-[#a09880] mb-2 font-semibold">Konfirmasi Password</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#a09880]">
                            <span class="material-symbols-outlined text-sm">lock</span>
                        </span>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password"
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-white/10 border border-white/10 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-[#c8a96e] focus:ring-1 focus:ring-[#c8a96e]/30 transition-all">
                    </div>
                </div>

                <button type="submit" class="w-full py-3 text-sm font-bold uppercase tracking-widest bg-gradient-to-r from-[#c8a96e] to-[#b58a4a] text-white rounded-xl hover:from-[#b89a5e] hover:to-[#a37a3a] active:scale-[0.98] transition-all duration-200 shadow-lg shadow-[#c8a96e]/20">
                    Daftar Sekarang
                </button>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/10"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-3 bg-transparent text-gray-500">Atau</span>
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-400">
                        Sudah memiliki akun? 
                        <a href="{{ route('login') }}" class="font-bold text-[#c8a96e] hover:text-[#d4b87a] transition-colors">
                            Login di sini
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection