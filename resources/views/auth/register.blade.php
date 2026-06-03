@extends('layouts.partials.auth.authpage')

@section('title', 'Sign Up')

@section('content')
<div class="pt-24 pb-20 flex items-center justify-center min-h-screen bg-gray-50">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        
        <div class="mb-8 text-center">
            <h2 class="font-['Playfair_Display'] text-3xl font-bold text-gray-900">
                Mulai Petualangan <em class="italic">Membaca</em>
            </h2>
            <p class="mt-2 text-sm text-[#a09880]">
                Buat akun baru Anda dalam hitungan menit
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Input Nama Lengkap -->
            <div>
                <label for="name" class="block text-xs uppercase tracking-wider text-[#a09880] mb-2 font-semibold">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nama lengkap Anda"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#c8a96e]">
                
                @error('name')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Email -->
            <div>
                <label for="email" class="block text-xs uppercase tracking-wider text-[#a09880] mb-2 font-semibold">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@email.com"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#c8a96e]">
                
                @error('email')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pilihan Role (Buyer / Seller) -->
            <div>
                <label for="role" class="block text-xs uppercase tracking-wider text-[#a09880] mb-2 font-semibold">Mendaftar Sebagai</label>
                <select id="role" name="role" required 
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#c8a96e] bg-white cursor-pointer">
                    <option value="buyer" {{ old('role') == 'buyer' ? 'selected' : '' }}>Pembeli (Buyer)</option>
                    <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Penjual (Seller)</option>
                </select>
                
                @error('role')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Password -->
            <div>
                <label for="password" class="block text-xs uppercase tracking-wider text-[#a09880] mb-2 font-semibold">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#c8a96e]">

                @error('password')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Konfirmasi Password -->
            <div>
                <label for="password_confirmation" class="block text-xs uppercase tracking-wider text-[#a09880] mb-2 font-semibold">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#c8a96e]">
            </div>

            <!-- Tombol Daftar -->
            <div class="pt-2">
                <button type="submit" class="w-full justify-center py-3 text-sm font-bold uppercase tracking-widest bg-[#c8a96e] text-white rounded-xl hover:bg-[#b0925a] transition duration-150 shadow-md">
                    Daftar Sekarang
                </button>
            </div>

            <!-- Pembatas -->
            <div class="relative my-4">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Atau</span>
                </div>
            </div>

            <!-- Tautan Kembali ke Login -->
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Sudah memiliki akun? 
                    <a href="{{ route('login') }}" class="font-bold text-[#c8a96e] hover:text-[#b0925a] transition duration-150">
                        Login di sini
                    </a>
                </p>
            </div> 
        </form>
    </div>
</div>
@endsection