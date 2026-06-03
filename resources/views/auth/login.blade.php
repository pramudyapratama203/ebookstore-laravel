@extends('layouts.partials.auth.authpage')

@section('title', 'Sign In')

@section('content')
<div class="pt-24 pb-20 flex items-center justify-center min-h-screen bg-gray-50">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        
        <div class="mb-8 text-center">
            <h2 class="font-['Playfair_Display'] text-3xl font-bold text-gray-900">
                Selamat Datang
            </h2>
            <p class="mt-2 text-sm text-[#a09880]">
                Silakan login ke akun E-Book Store Anda
            </p>
        </div>

        <!-- Status Sesi Auth jika menggunakan komponen Laravel Breeze asli -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Input Email -->
            <div>
                <label for="email" class="block text-xs uppercase tracking-wider text-[#a09880] mb-2 font-semibold">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@email.com"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#c8a96e]">
                
                @error('email')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Password -->
            <div class="mt-4">
                <label for="password" class="block text-xs uppercase tracking-wider text-[#a09880] mb-2 font-semibold">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-[#c8a96e]">

                @error('password')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ingat Saya -->
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-[#c8a96e] focus:ring-[#c8a96e]">
                    <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
                </label>
            </div>

            <!-- Tombol Masuk -->
            <div class="mt-6">
                <button type="submit" class="w-full justify-center py-3 text-sm font-bold uppercase tracking-widest bg-[#c8a96e] text-white rounded-xl hover:bg-[#b0925a] transition duration-150 shadow-md">
                    Masuk Sekarang
                </button>
            </div>

            <!-- Pembatas -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Atau</span>
                </div>
            </div>

            <!-- Tautan Registrasi & Lupa Password -->
            <div class="text-center space-y-2 flex flex-col">
                <p class="text-sm text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-bold text-[#c8a96e] hover:text-[#b0925a] transition duration-150">
                        Daftar di sini
                    </a>
                </p>
                <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:text-[#c8a96e] transition duration-150">
                    Lupa Password?
                </a>
            </div> 
        </form>
    </div>
</div>
@endsection