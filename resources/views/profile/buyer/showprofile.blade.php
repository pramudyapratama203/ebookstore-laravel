@extends('layouts.buyer')

@section('title', 'Profil Buyer')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<main class="w-full pt-24 min-h-screen bg-[#fcf9f0] transition-all duration-300">
    <div class="w-full max-w-2xl mx-auto px-4 sm:px-6 py-8 space-y-10">
        
        <section class="flex flex-col items-center text-center">
            <div class="relative group">
                <div class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden border-4 border-white shadow-[0_4px_20px_rgba(122,79,55,0.15)] mb-6 transition-transform duration-300 group-hover:scale-[1.02]">
                    <img alt="Profile Photo" class="w-full h-full object-cover grayscale-[10%] sepia-[5%]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAswKziLPZwnF5uHTPjYbKhvqJ5Z6bHOu5I37uRhzvydyOUioQOe_ktNc19n8_kmHbr4bdKUlRpUrQdF7q3GYMqRaral3w6N3c_3okuVm5f2j3ROkJxn3L97pdbpfKfYoEX6mmAEXUq32YEN_J11fz2MpzZ5ZDeiKACObID4GxOv21A81TCFw-HKdk72GOI_Ky0012IH6kNWCGyWMc4Uzwm2zNtK2J9TI557tM_FC4L5dnJJ4ksfGsVA9XvSheFz9jQH9N8-LMp3fnU"/>
                </div>
                <button type="button" class="absolute bottom-6 right-2 bg-[#5f3822] text-white p-2 rounded-full shadow-md hover:bg-[#7a4f37] transition-all duration-200">
                    <span class="material-symbols-outlined text-[18px]">edit</span>
                </button>
            </div>
            
            <h1 class="font-['Literata'] text-2xl sm:text-3xl font-bold text-[#5f3822]">{{ $user->name }}</h1>
            <p class="font-['Source_Serif_4'] text-sm text-gray-400 italic mt-1">{{ $user->email }}</p>
            
            <div class="flex items-center justify-center gap-4 w-full mt-6 opacity-20">
                <div class="h-px w-20 bg-[#5f3822]"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-[#5f3822]"></div>
                <div class="h-px w-20 bg-[#5f3822]"></div>
            </div>
        </section>

        
        <form action="#" method="POST" class="bg-white p-6 sm:p-10 rounded-2xl border border-[#e8dfd1] shadow-[0_4px_20px_-2px_rgba(122,79,55,0.05)] space-y-6">
            @csrf
            
            
            <div class="flex flex-col space-y-1.5">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider flex items-center gap-1.5" for="full-name">
                    <span class="material-symbols-outlined text-sm text-[#5f3822]">person</span> Nama Lengkap
                </label>
                <input class="w-full bg-[#fcf9f0]/40 border border-gray-200 focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] rounded-xl p-3.5 text-gray-800 text-sm transition-all shadow-inner" 
                       id="full-name" name="name" type="text" value="{{ $user->name }}"/>
            </div>

            <div class="flex flex-col space-y-1.5">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider flex items-center gap-1.5" for="email">
                    <span class="material-symbols-outlined text-sm text-[#5f3822]">mail</span> Alamat Email
                </label>
                <input class="w-full bg-[#fcf9f0]/40 border border-gray-200 focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] rounded-xl p-3.5 text-gray-800 text-sm transition-all shadow-inner" 
                       id="email" name="email" type="email" value="{{ $user->email }}"/>
            </div>

            <div class="flex flex-col space-y-1.5">
                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider flex items-center gap-1.5" for="phone">
                    <span class="material-symbols-outlined text-sm text-[#5f3822]">call</span> Nomor Telepon
                </label>
                <input class="w-full bg-[#fcf9f0]/40 border border-gray-200 focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] rounded-xl p-3.5 text-gray-800 text-sm transition-all shadow-inner" 
                       id="phone" name="phone" type="tel" value="{{ $user->phone }}"/>
            </div>
            
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-center gap-4 border-t border-gray-50">
                <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-[#5f3822] text-white rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-[#7a4f37] active:scale-[0.98] transition-all shadow-md flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">save</span>
                    <span id="save-text">Simpan Perubahan</span>
                </button>
                
                <a href="{{ route('logout') }}" class="w-full sm:w-auto px-8 py-3.5 bg-red-50 border border-red-200 text-red-700 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-red-100/70 active:scale-[0.98] transition-all text-center flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">logout</span>
                    <span id="logout-text">Keluar Akun</span>
                </a>
            </div>
        </form>

    </div>
</main>
@endsection