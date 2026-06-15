@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.seller')

@section('title', 'Tambah Buku')

@section('content')
@if (session('success'))
    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
@endif

<main class="w-full min-h-screen bg-[#fcf9f0] pt-24 pb-12 transition-all duration-300">
    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10 text-center sm:text-left border-b border-[#e8dfd1] pb-6">
            <h2 class="font-['Literata'] text-2xl sm:text-3xl lg:text-4xl font-bold text-[#5f3822]">
                    Tambah Buku
            </h2>
            <p class="text-xs sm:text-sm text-gray-500 mt-1 font-['Source_Serif_4'] italic">
                Silakan lengkapi informasi bibliografi dan inventaris buku baru Anda di bawah ini.  
            </p>
        </div>

        <form action="{{ route(Auth::user()->role === 'admin' ? 'admin.store' : 'seller.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">
                
                <div class="lg:col-span-8 space-y-6 sm:space-y-8">
                    
                    <section class="bg-white border border-[#e8dfd1] p-6 sm:p-8 rounded-2xl shadow-[0_4px_20px_-2px_rgba(122,79,55,0.03)] transition-all duration-300 hover:shadow-[0_6px_24px_-2px_rgba(122,79,55,0.05)]">
                        <div class="flex items-center gap-3 mb-6 sm:mb-8 border-b border-gray-100 pb-4">
                            <span class="material-symbols-outlined text-[#5f3822] text-xl sm:text-2xl">auto_stories</span>
                            <h3 class="text-base sm:text-lg text-gray-900 font-bold tracking-wide">Informasi Buku</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold mb-2 text-gray-700 uppercase tracking-wider">Judul Buku <span class="text-red-500 font-bold">*</span></label>
                                <input type="text" name="title" class="w-full bg-[#fcf9f0]/20 border border-gray-200 p-3 text-sm rounded-xl focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] text-gray-900 shadow-sm transition-all" placeholder="Masukkan judul lengkap buku" required/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-2 text-gray-700 uppercase tracking-wider">Pengarang <span class="text-red-500 font-bold">*</span></label>
                                <input type="text" name="author" class="w-full bg-[#fcf9f0]/20 border border-gray-200 p-3 text-sm rounded-xl focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] text-gray-900 shadow-sm transition-all" placeholder="Nama penulis atau kreator" required/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-2 text-gray-700 uppercase tracking-wider">Kategori <span class="text-red-500 font-bold">*</span></label>
                                <input type="text" name="category" class="w-full bg-[#fcf9f0]/20 border border-gray-200 p-3 text-sm rounded-xl focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] text-gray-900 shadow-sm transition-all" placeholder="Fiksi, Misteri, Sejarah" required/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-2 text-gray-700 uppercase tracking-wider">Penerbit (Publisher)</label>
                                <input type="text" name="publisher" class="w-full bg-[#fcf9f0]/20 border border-gray-200 p-3 text-sm rounded-xl focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] text-gray-900 shadow-sm transition-all" placeholder="Nama perusahaan penerbit"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-2 text-gray-700 uppercase tracking-wider">Tahun Terbit</label>
                                <input type="number" name="year" min="1000" max="2100" class="w-full bg-[#fcf9f0]/20 border border-gray-200 p-3 text-sm rounded-xl focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] text-gray-900 shadow-sm transition-all" placeholder="Contoh: 2026" required/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-2 text-gray-700 uppercase tracking-wider">Bahasa (Language)</label>
                                <select name="language" class="w-full bg-[#fcf9f0]/20 border border-gray-200 p-3 text-sm rounded-xl focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] text-gray-900 shadow-sm transition-all">
                                    <option value="english">English</option>
                                    <option value="indonesia" selected>Bahasa Indonesia</option>
                                    <option value="french">French</option>
                                    <option value="latin">Latin</option>
                                    <option value="other">Lainnya</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-2 text-gray-700 uppercase tracking-wider">Jumlah Halaman <span class="text-red-500 font-bold">*</span></label>
                                <input type="number" name="pages" min="1" class="w-full bg-[#fcf9f0]/20 border border-gray-200 p-3 text-sm rounded-xl focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] text-gray-900 shadow-sm transition-all" placeholder="250" required/>
                            </div>
                        </div>
                    </section>

                    <section class="bg-white border border-[#e8dfd1] p-6 sm:p-8 rounded-2xl shadow-[0_4px_20px_-2px_rgba(122,79,55,0.03)] transition-all duration-300 hover:shadow-[0_6px_24px_-2px_rgba(122,79,55,0.05)]">
                        <div class="flex items-center gap-3 mb-5 border-b border-gray-100 pb-4">
                            <span class="material-symbols-outlined text-[#5f3822] text-xl sm:text-2xl">edit_note</span>
                            <h3 class="text-base sm:text-lg text-gray-900 font-bold tracking-wide">Isi Deskripsi Buku</h3>
                        </div>
                        <div class="border border-gray-200 rounded-xl overflow-hidden focus-within:border-[#5f3822] focus-within:ring-1 focus-within:ring-[#5f3822] transition-all duration-200 shadow-sm">
                            <textarea name="description" class="w-full bg-[#fcf9f0]/10 border-none p-4 text-sm text-gray-900 placeholder-gray-400 resize-none focus:outline-none focus:ring-0" placeholder="Masukkan sinopsis atau deskripsi ringkas mengenai karya buku ini..." rows="7"></textarea>
                        </div>
                    </section>

                    <section class="bg-white border border-[#e8dfd1] p-6 sm:p-8 rounded-2xl shadow-[0_4px_20px_-2px_rgba(122,79,55,0.03)] transition-all duration-300 hover:shadow-[0_6px_24px_-2px_rgba(122,79,55,0.05)]">
                        <div class="flex items-center gap-3 mb-6 sm:mb-8 border-b border-gray-100 pb-4">
                            <span class="material-symbols-outlined text-[#5f3822] text-xl sm:text-2xl">payments</span>
                            <h3 class="text-base sm:text-lg text-gray-900 font-bold tracking-wide">Manajemen Harga & Stok</h3>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6">
                            <div>
                                <label class="block text-xs font-bold mb-2 text-gray-700 uppercase tracking-wider">Harga Buku <span class="text-red-500 font-bold">*</span></label>
                                <div class="relative rounded-xl shadow-sm">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-900 font-bold text-sm select-none">Rp</span>
                                    <input type="number" name="price" min="0" class="w-full bg-[#fcf9f0]/20 border border-gray-200 py-3 pl-10 pr-4 text-sm rounded-xl focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] text-right text-gray-900 font-semibold transition-all" placeholder="185.000" required/>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-2 text-gray-700 uppercase tracking-wider">Jumlah Stok <span class="text-red-500 font-bold">*</span></label>
                                <div class="relative rounded-xl shadow-sm">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-medium text-sm select-none"><span class="material-symbols-outlined text-base align-middle">inventory_2</span></span>
                                    <input type="number" name="stock" min="0" class="w-full bg-[#fcf9f0]/20 border border-gray-200 py-3 pl-10 pr-4 text-sm rounded-xl focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] text-center text-gray-900 font-semibold transition-all" placeholder="12" required/>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="bg-white border border-[#e8dfd1] p-6 sm:p-8 rounded-2xl shadow-[0_4px_20px_-2px_rgba(122,79,55,0.03)] transition-all duration-300 hover:shadow-[0_6px_24px_-2px_rgba(122,79,55,0.05)]">
                        <div class="flex items-center gap-3 mb-6 sm:mb-8 border-b border-gray-100 pb-4">
                            <span class="material-symbols-outlined text-[#5f3822] text-xl sm:text-2xl">upload_file</span>
                            <h3 class="text-base sm:text-lg text-gray-900 font-bold tracking-wide">Upload File Buku</h3>
                        </div>
                        <div>
                            <label class="block text-xs font-bold mb-2 text-gray-700 uppercase tracking-wider">File E-book (PDF/EPUB/MOBI)</label>
                            <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-[#5f3822] transition-colors cursor-pointer" onclick="document.getElementById('file-input').click()">
                                <span class="material-symbols-outlined text-3xl text-gray-300 block mb-2">cloud_upload</span>
                                <p class="text-sm text-gray-500">Klik untuk upload file buku digital</p>
                                <p class="text-xs text-gray-400 mt-1">Maks 100MB, format: PDF, EPUB, MOBI</p>
                                <input id="file-input" type="file" name="file" accept=".pdf,.epub,.mobi" class="hidden" onchange="updateFileName(this)">
                                <div id="file-name" class="mt-3 text-xs text-[#5f3822] font-semibold hidden"></div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="lg:col-span-4 space-y-6 sm:space-y-8">
                    
                    <section class="bg-white border border-[#e8dfd1] p-6 sm:p-8 rounded-2xl shadow-[0_4px_20px_-2px_rgba(122,79,55,0.03)] transition-all duration-300 hover:shadow-[0_6px_24px_-2px_rgba(122,79,55,0.05)]">
                        <div class="flex items-center gap-3 mb-5 border-b border-gray-100 pb-4">
                            <span class="material-symbols-outlined text-[#5f3822] text-xl">palette</span>
                            <h3 class="text-sm sm:text-base text-gray-900 font-bold tracking-wide">Warna Sampul Buku</h3>
                        </div>
                        
                        <div class="space-y-5">
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Pilih Palet Estetis</label>
                            
                            <div class="flex flex-wrap gap-3.5 justify-start sm:justify-between items-center">
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="cover_color" value="#5f3822" class="sr-only color-radio" checked>
                                    <span class="w-9 h-9 rounded-full block border border-black/10 transition-all duration-200 shadow-sm group-hover:scale-105 ring-offset-2" style="background-color: #5f3822;"></span>
                                </label>

                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="cover_color" value="#3b5998" class="sr-only color-radio">
                                    <span class="w-9 h-9 rounded-full block border border-black/10 transition-all duration-200 shadow-sm group-hover:scale-105 ring-offset-2" style="background-color: #3b5998;"></span>
                                </label>

                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="cover_color" value="#e4405f" class="sr-only color-radio">
                                    <span class="w-9 h-9 rounded-full block border border-black/10 transition-all duration-200 shadow-sm group-hover:scale-105 ring-offset-2" style="background-color: #e4405f;"></span>
                                </label>

                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="cover_color" value="#55acee" class="sr-only color-radio">
                                    <span class="w-9 h-9 rounded-full block border border-black/10 transition-all duration-200 shadow-sm group-hover:scale-105 ring-offset-2" style="background-color: #55acee;"></span>
                                </label>

                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="cover_color" value="#0077b5" class="sr-only color-radio">
                                    <span class="w-9 h-9 rounded-full block border border-black/10 transition-all duration-200 shadow-sm group-hover:scale-105 ring-offset-2" style="background-color: #0077b5;"></span>
                                </label>
                            </div>

                            <div class="pt-3 border-t border-gray-50">
                                <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Custom Warna Hex</label>
                                <div class="flex items-center gap-3">
                                    <div class="flex-1 relative rounded-xl shadow-sm">
                                        <input type="text" id="custom-color-text" name="cover_color_custom" placeholder="#5f3822" maxlength="7" 
                                            class="w-full bg-[#fcf9f0]/20 border border-gray-200 px-3 py-2.5 text-xs font-mono text-gray-900 rounded-xl focus:outline-none focus:border-[#5f3822] focus:ring-1 focus:ring-[#5f3822] transition-all">
                                    </div>
                                    
                                    <div id="custom-preview-box" class="w-10 h-10 rounded-xl border border-black/10 shadow-[inset_0_2px_4px_rgba(0,0,0,0.06)] flex items-center justify-center shrink-0 transition-all duration-300 relative overflow-hidden" style="background-color: #5f3822;">
                                        <span class="material-symbols-outlined text-white/30 text-base select-none z-10">book</span>
                                        <div class="absolute left-1 top-0 bottom-0 w-1.5 bg-black/10"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="bg-[#5f3822] border border-[#4d2d1b] p-6 sm:p-8 text-white shadow-xl flex flex-col gap-4 rounded-2xl relative overflow-hidden">
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-white/5 rounded-full select-none pointer-events-none"></div>
                        
                        <h3 class="text-base sm:text-lg font-bold tracking-wide flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm bg-white/20 p-1 rounded-lg">verified</span>
                            Konfirmasi Data
                        </h3>
                        <p class="text-xs sm:text-sm text-amber-50/80 font-medium leading-relaxed mb-3">
                            Silakan periksa kembali seluruh informasi spesifikasi buku yang telah dimasukkan sebelum menambahkannya ke sistem.
                        </p>
                        
                        <div class="space-y-3 pt-2 border-t border-white/10 z-10">
                            <button type="submit" class="w-full bg-white text-[#5f3822] font-bold py-3.5 text-sm transition-all duration-200 hover:bg-amber-50 active:scale-[0.98] rounded-xl shadow-md flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-base">add</span>
                                Tambah Buku
                            </button>
                            <a href="{{ route(Auth::user()->role === 'admin' ? 'admin.catalog' : 'seller.catalog') }}" class="w-full border border-white/20 text-white font-bold py-3.5 text-sm hover:bg-white/10 active:scale-[0.98] transition-all duration-200 rounded-xl text-center block">
                                Batal
                            </a>
                        </div>
                    </section>
                </div>

            </div>
        </form>

        <div class="py-16 flex items-center justify-center">
            <div class="w-20 h-[1px] bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
            <div class="mx-4 text-gray-300 text-[10px] select-none">◆</div>
            <div class="w-20 h-[1px] bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
        </div>
        
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorInput = document.getElementById('custom-color-text');
        const previewBox = document.getElementById('custom-preview-box');
        const radios = document.querySelectorAll('.color-radio');

        function updateRadioRing() {
            radios.forEach(radio => {
                const span = radio.nextElementSibling;
                if (radio.checked) {
                    span.classList.add('ring-2', 'ring-[#5f3822]');
                } else {
                    span.classList.remove('ring-2', 'ring-[#5f3822]');
                }
            });
        }
        updateRadioRing();

        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    previewBox.style.backgroundColor = this.value;
                    colorInput.value = this.value; 
                    updateRadioRing();
                }
            });
        });

        colorInput.addEventListener('input', function() {
            let colorValue = this.value.trim();

            if (colorValue.length > 0 && !colorValue.startsWith('#')) {
                colorValue = '#' + colorValue;
                this.value = colorValue;
            }

            if (colorValue.length === 4 || colorValue.length === 7) {
                previewBox.style.backgroundColor = colorValue;
                
                radios.forEach(radio => {
                    if (radio.value.toLowerCase() === colorValue.toLowerCase()) {
                        radio.checked = true;
                    } else {
                        radio.checked = false;
                    }
                });
                updateRadioRing();
            }
        });
    });

    function updateFileName(input) {
        const nameDiv = document.getElementById('file-name');
        if (input.files.length > 0) {
            nameDiv.textContent = input.files[0].name;
            nameDiv.classList.remove('hidden');
        }
    }
</script>
@endsection