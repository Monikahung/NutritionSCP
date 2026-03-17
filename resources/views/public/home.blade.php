@extends('public.layout')

@section('content')

<main class="flex-grow">
        
        <section id="hero" class="w-full bg-tealmist min-h-[calc(100vh-72px)] px-6 lg:px-16 py-12 lg:py-0 flex items-center">
            <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="flex flex-col gap-6 pr-0 lg:pr-8">
                    <h1 class="text-4xl lg:text-[3rem] font-bold leading-[1.1] text-jetblack tracking-tight">
                        Kenali Nutrisi, Pilih Produk Makanan Lebih Sehat
                    </h1>
                    <p class="text-lg lg:text-xl leading-relaxed text-jetblack font-medium w-full lg:w-11/12">
                        Pelajari kandungan gizi pada produk makanan kemasan, gunakan kalkulator nutrisi, dan temukan berbagai artikel untuk membantu Anda membuat pilihan makanan yang lebih sehat.
                    </p>
                </div>
                <div class="w-full flex justify-end">
                    <div class="bg-[#F4F5F6] w-full max-w-[500px] aspect-square flex flex-col items-center justify-center shadow-sm rounded-2xl">
                        <h2 class="text-4xl lg:text-5xl font-semibold text-jetblack text-center leading-tight">
                            Ilustrasi<br>Banner
                        </h2>
                    </div>
                </div>
            </div>
        </section>

        <section id="tentang-kami" class="w-full bg-[#F8F9FA] py-20 px-6 lg:px-16">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-14 flex flex-col gap-3">
                    <h2 class="text-4xl font-bold text-jetblack">Tentang Kami</h2>
                    <p class="text-lg text-jetblack font-medium">Pelajari lebih lanjut tentang layanan yang kami sediakan di NutriCare</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-tealmist p-10 flex flex-col items-center justify-center text-center gap-4 min-h-[250px] rounded-2xl">
                        <h3 class="text-xl font-bold text-jetblack">Informasi Nutrisi Produk</h3>
                        <p class="text-jetblack font-medium leading-relaxed">
                            Tersedia informasi berbagai produk makanan dan minuman kemasan beserta kandungan nutrisinya.
                        </p>
                    </div>

                    <div class="bg-tealmist p-10 flex flex-col items-center justify-center text-center gap-4 min-h-[250px] rounded-2xl">
                        <h3 class="text-xl font-bold text-jetblack">Kalkulator Nutrisi</h3>
                        <p class="text-jetblack font-medium leading-relaxed">
                            Membantu menghitung estimasi kandungan gizi dari produk kemasan yang dikonsumsi.
                        </p>
                    </div>

                    <div class="bg-tealmist p-10 flex flex-col items-center justify-center text-center gap-4 min-h-[250px] rounded-2xl">
                        <h3 class="text-xl font-bold text-jetblack">Artikel Seputar Nutrisi</h3>
                        <p class="text-jetblack font-medium leading-relaxed">
                            Tersedia berbagai artikel informatif seputar gizi, nutrisi, serta pola makan sehat dan bergizi.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="nutrisi-produk" class="w-full bg-tealmist py-20 px-6 lg:px-16">
            <div class="max-w-7xl mx-auto flex flex-col gap-12">
                <div class="text-center flex flex-col gap-3">
                    <h2 class="text-4xl font-bold text-jetblack">Nutrisi Produk</h2>
                    <p class="text-lg text-jetblack font-medium">
                        Pelajari lebih lanjut tentang nutrisi yang terkandung dalam produk kemasan
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <button class="bg-white py-3 px-6 text-center font-bold text-jetblack hover:bg-gray-50 transition shadow-sm rounded-xl">
                        Sangat Sesuai
                    </button>
                    <button class="bg-white py-3 px-6 text-center font-bold text-jetblack hover:bg-gray-50 transition shadow-sm rounded-xl">
                        Sesuai
                    </button>
                    <button class="bg-white py-3 px-6 text-center font-bold text-jetblack hover:bg-gray-50 transition shadow-sm rounded-xl">
                        Buruk
                    </button>
                    
                    <div class="bg-white flex items-center justify-between px-4 py-2 shadow-sm rounded-xl">
                        <input type="text" placeholder="Pencarian" class="w-full outline-none text-jetblack font-bold bg-transparent placeholder:text-jetblack/70">
                        <button class="w-8 h-8 rounded-full bg-tealmist hover:bg-tealmist/80 transition flex-shrink-0">
                            <i class="fa-solid fa-magnifying-glass text-white text-sm"></i>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-4 shadow-sm flex flex-col gap-4 rounded-2xl">
                        <div class="w-full aspect-square bg-tealmist/80 flex flex-col items-center justify-center text-center p-4 rounded-xl">
                            <span class="text-3xl font-bold text-white leading-tight">Gambar<br>Produk</span>
                        </div>
                        <h3 class="font-bold text-lg text-jetblack text-center mt-2">Teh Botol Sostro</h3>
                        <button class="w-full bg-tealmist hover:bg-tealmist/80 text-white font-semibold py-2.5 transition rounded-lg">
                            Lihat Detail
                        </button>
                    </div>

                    <div class="bg-white p-4 shadow-sm flex flex-col gap-4 rounded-2xl">
                        <div class="w-full aspect-square bg-tealmist/80 flex flex-col items-center justify-center text-center p-4 rounded-xl">
                            <span class="text-3xl font-bold text-white leading-tight">Gambar<br>Produk</span>
                        </div>
                        <h3 class="font-bold text-lg text-jetblack text-center mt-2">Teh Botol Sostro</h3>
                        <button class="w-full bg-tealmist hover:bg-tealmist/80 text-white font-semibold py-2.5 transition rounded-lg">
                            Lihat Detail
                        </button>
                    </div>

                    <div class="bg-white p-4 shadow-sm flex flex-col gap-4 rounded-2xl">
                        <div class="w-full aspect-square bg-tealmist/80 flex flex-col items-center justify-center text-center p-4 rounded-xl">
                            <span class="text-3xl font-bold text-white leading-tight">Gambar<br>Produk</span>
                        </div>
                        <h3 class="font-bold text-lg text-jetblack text-center mt-2">Teh Botol Sostro</h3>
                        <button class="w-full bg-tealmist hover:bg-tealmist/80 text-white font-semibold py-2.5 transition rounded-lg">
                            Lihat Detail
                        </button>
                    </div>

                    <div class="bg-white p-4 shadow-sm flex flex-col gap-4 rounded-2xl">
                        <div class="w-full aspect-square bg-tealmist/80 flex flex-col items-center justify-center text-center p-4 rounded-xl">
                            <span class="text-3xl font-bold text-white leading-tight">Gambar<br>Produk</span>
                        </div>
                        <h3 class="font-bold text-lg text-jetblack text-center mt-2">Teh Botol Sostro</h3>
                        <button class="w-full bg-tealmist hover:bg-tealmist/80 text-white font-semibold py-2.5 transition rounded-lg">
                            Lihat Detail
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-8 mt-4">
                    <button class="w-12 h-12 rounded-full bg-white text-[0.6rem] font-bold text-jetblack hover:bg-gray-100 transition shadow-sm flex items-center justify-center">
                        <i class="fa-solid fa-chevron-left text-jetblack text-lg"></i>
                    </button>
                    <button class="w-12 h-12 rounded-full bg-white text-[0.6rem] font-bold text-jetblack hover:bg-gray-100 transition shadow-sm flex items-center justify-center">
                        <i class="fa-solid fa-chevron-right text-jetblack text-lg"></i>
                    </button>
                </div>
            </div>
        </section>

        <section id="kalkulator" class="w-full bg-[#F8F9FA] py-20 px-6 lg:px-16 flex items-center">
            <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <div class="w-full flex justify-center lg:justify-start">
                    <div class="bg-tealmist w-full max-w-[500px] aspect-square flex flex-col items-center justify-center shadow-sm p-8 rounded-2xl">
                        <h2 class="text-4xl lg:text-5xl font-semibold text-white text-center leading-tight">
                            Ilustrasi<br>Kalkulator
                        </h2>
                    </div>
                </div>

                <div class="flex flex-col gap-6 items-start">
                    <h2 class="text-3xl lg:text-4xl font-bold text-jetblack tracking-tight">
                        Cek Nutrisi Produk Anda
                    </h2>
                    <p class="text-lg text-jetblack font-medium leading-relaxed max-w-xl">
                        Gunakan kalkulator nutrisi untuk mengetahui estimasi kandungan gizi dari produk makanan dan minuman kemasan. Fitur ini membantu Anda membuat pilihan konsumsi yang lebih sehat dan bijak
                    </p>
                    <a href="#" class="bg-tealmist hover:bg-tealmist/80 text-white font-semibold py-3 px-8 mt-2 transition duration-200 shadow-sm rounded-lg">
                        Coba Sekarang
                    </a>
                </div>
            </div>
        </section>

        <!-- <section id="artikel" class="w-full bg-tealmist py-20 px-6 lg:px-16">
            <div class="max-w-7xl mx-auto">
                <div class="text-center flex flex-col gap-3 mb-14">
                    <h2 class="text-4xl font-bold text-jetblack tracking-tight">Artikel</h2>
                    <p class="text-lg text-jetblack font-medium">
                        Pelajari lebih lanjut tentang informasi seputar gizi, nutrisi, serta pola makan yang sehat
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <a href="#" class="group flex flex-col transition duration-300 hover:-translate-y-1 rounded-2xl overflow-hidden">
                        <div class="w-full aspect-[4/3] flex items-center justify-center p-6 bg-tealmist/50">
                            <span class="text-3xl font-bold text-white text-center leading-tight drop-shadow-sm">Gambar<br>Artikel</span>
                        </div>
                        <div class="bg-white p-6 shadow-sm flex-grow flex items-center">
                            <h3 class="text-lg font-bold text-jetblack leading-snug group-hover:text-tealmist transition duration-200">
                                Apa Saja Produk Bergizi Untuk Masa Pertumbuhan? Yuk Disimak!
                            </h3>
                        </div>
                    </a>

                    <a href="#" class="group flex flex-col transition duration-300 hover:-translate-y-1 rounded-2xl overflow-hidden">
                        <div class="w-full aspect-[4/3] flex items-center justify-center p-6 bg-tealmist/50">
                            <span class="text-3xl font-bold text-white text-center leading-tight drop-shadow-sm">Gambar<br>Artikel</span>
                        </div>
                        <div class="bg-white p-6 shadow-sm flex-grow flex items-center">
                            <h3 class="text-lg font-bold text-jetblack leading-snug group-hover:text-tealmist transition duration-200">
                                Apa Saja Produk Bergizi Untuk Masa Pertumbuhan? Yuk Disimak!
                            </h3>
                        </div>
                    </a>

                    <a href="#" class="group flex flex-col transition duration-300 hover:-translate-y-1 rounded-2xl overflow-hidden">
                        <div class="w-full aspect-[4/3] flex items-center justify-center p-6 bg-tealmist/50">
                            <span class="text-3xl font-bold text-white text-center leading-tight drop-shadow-sm">Gambar<br>Artikel</span>
                        </div>
                        <div class="bg-white p-6 shadow-sm flex-grow flex items-center">
                            <h3 class="text-lg font-bold text-jetblack leading-snug group-hover:text-tealmist transition duration-200">
                                Apa Saja Produk Bergizi Untuk Masa Pertumbuhan? Yuk Disimak!
                            </h3>
                        </div>
                    </a>
                </div>
            </div>
        </section> -->

</main>

@endsection