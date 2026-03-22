@extends('public.layout')

@section('title', 'Beranda')

@section('content')

    <main class="grow">

        {{-- Hero Section --}}
        <section id="hero"
            class="w-full bg-tealmist min-h-[calc(100vh-72px)] px-6 lg:px-16 py-12 lg:py-0 flex items-center">
            <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="flex flex-col gap-6 pr-0 lg:pr-8">
                    {{-- Hero Title --}}
                    <h1 class="text-4xl lg:text-[3rem] font-semibold leading-[1.1] text-jetblack tracking-tight">
                        Kenali Nutrisi, Pilih Produk Makanan Lebih Sehat
                    </h1>
                    {{-- Hero Description --}}
                    <p class="text-lg lg:text-xl leading-relaxed text-jetblack font-medium w-full lg:w-11/12">
                        Pelajari kandungan gizi pada produk makanan kemasan dan gunakan kalkulator nutrisi untuk membantu Anda membuat pilihan makanan yang lebih sehat.
                    </p>
                </div>
                <div class="w-full flex justify-end">
                    <div class="w-full max-w-6xl  rounded-2xl overflow-hidden">
                        {{-- Hero Image --}}
                        <img src="{{ asset('img/banner.png') }}" alt="Banner NutriCare - Kenali Nutrisi Produk"
                            class="w-full h-auto block">
                    </div>
                </div>
            </div>
        </section>

        {{-- About Us --}}
        <section id="about-us" class="w-full bg-softivory py-20 px-6 lg:px-16">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-10 flex flex-col gap-3">
                    {{-- About Us Title --}}
                    <h2 class="text-4xl font-bold text-jetblack">Tentang Kami</h2>
                    {{-- About Us Description --}}
                    <p class="text-lg text-jetblack font-medium">Pelajari lebih lanjut tentang layanan yang kami sediakan di
                        NutriCare</p>
                </div>

                {{-- About Us Content --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 lg:mr-36 lg:ml-36">
                    {{-- Info Nutrisi Produk --}}
                    <div
                        class="bg-tealmist p-10 flex flex-col items-center justify-center text-center gap-4 min-h-55 rounded-2xl">
                        <h3 class="text-xl font-bold text-jetblack">Informasi Nutrisi Produk</h3>
                        <p class="text-jetblack font-medium leading-relaxed">
                            Tersedia informasi berbagai produk makanan dan minuman kemasan beserta kandungan nutrisinya
                        </p>
                    </div>

                    {{-- Kalkulator Nutrisi --}}
                    <div
                        class="bg-tealmist p-10 flex flex-col items-center justify-center text-center gap-4 min-h-55 rounded-2xl">
                        <h3 class="text-xl font-bold text-jetblack">Kalkulator Nutrisi</h3>
                        <p class="text-jetblack font-medium leading-relaxed">
                            Membantu menghitung estimasi kandungan gizi dari produk kemasan yang dikonsumsi
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Nutrition Products --}}
        <section id="nutrition-products" class="w-full bg-tealmist py-20 px-6 lg:px-16">
            <div class="max-w-7xl mx-auto flex flex-col gap-10">
                <div class="text-center flex flex-col gap-3">
                    {{-- Nutrition Products Title --}}
                    <h2 class="text-4xl font-bold text-jetblack">Nutrisi Produk</h2>
                    {{-- Nutrition Products Description --}}
                    <p class="text-lg text-jetblack font-medium">
                        Pelajari lebih lanjut tentang nutrisi yang terkandung dalam produk kemasan
                    </p>
                </div>

                {{-- Nutrition Products Filter & Search --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    {{-- Filter Buttons --}}
                    <button
                        class="bg-softivory py-3 px-6 text-center font-bold text-jetblack hover:bg-softivory/60 transition shadow-sm rounded-xl">
                        Sangat Sesuai
                    </button>
                    <button
                        class="bg-softivory py-3 px-6 text-center font-bold text-jetblack hover:bg-softivory/60 transition shadow-sm rounded-xl">
                        Sesuai
                    </button>
                    <button
                        class="bg-softivory py-3 px-6 text-center font-bold text-jetblack hover:bg-softivory/60 transition shadow-sm rounded-xl">
                        Buruk
                    </button>

                    {{-- Search Bar --}}
                    <div class="bg-softivory flex items-center justify-between px-4 py-2 shadow-sm rounded-xl">
                        <input type="text" placeholder="Cari Produk..."
                            class="w-full outline-none text-jetblack font-medium bg-transparent placeholder:text-jetblack/70">
                        <button class="w-8 h-8">
                            <i class="fa-solid fa-magnifying-glass text-tealmist text-medium"></i>
                        </button>
                    </div>
                </div>

                {{-- Nutrition Products List --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    {{-- Product 1 --}}
                    <div class="bg-softivory p-4 shadow-sm flex flex-col gap-4 rounded-2xl">
                        <div class="w-full aspect-square rounded-xl">
                            <img src="{{ asset('img/img-product/product-1.png') }}" alt="Gambar Produk Teh Botol Sosro"
                                class="w-full h-full object-cover rounded-lg">
                        </div>
                        <h3 class="font-bold text-lg text-jetblack text-center">Teh Botol Sosro</h3>
                        <button
                            class="w-full bg-tealmist hover:bg-tealmist/80 text-softivory font-semibold py-2.5 transition rounded-lg">
                            Lihat Detail
                        </button>
                    </div>

                    {{-- Product 2 --}}
                    <div class="bg-softivory p-4 shadow-sm flex flex-col gap-4 rounded-2xl">
                        <div class="w-full aspect-square rounded-xl">
                            <img src="{{ asset('img/img-product/product-2.png') }}" alt="Gambar Produk Teh Botol Sosro"
                                class="w-full h-full object-cover rounded-lg">
                        </div>
                        <h3 class="font-bold text-lg text-jetblack text-center">Indomie Goreng</h3>
                        <button
                            class="w-full bg-tealmist hover:bg-tealmist/80 text-softivory font-semibold py-2.5 transition rounded-lg">
                            Lihat Detail
                        </button>
                    </div>

                    {{-- Product 3 --}}
                    <div class="bg-softivory p-4 shadow-sm flex flex-col gap-4 rounded-2xl">
                        <div class="w-full aspect-square rounded-xl">
                            <img src="{{ asset('img/img-product/product-3.png') }}" alt="Gambar Produk Teh Botol Sosro"
                                class="w-full h-full object-cover rounded-lg">
                        </div>
                        <h3 class="font-bold text-lg text-jetblack text-center">Ultra Milk</h3>
                        <button
                            class="w-full bg-tealmist hover:bg-tealmist/80 text-softivory font-semibold py-2.5 transition rounded-lg">
                            Lihat Detail
                        </button>
                    </div>

                    {{-- Product 4 --}}
                    <div class="bg-softivory p-4 shadow-sm flex flex-col gap-4 rounded-2xl">
                        <div class="w-full aspect-square rounded-xl">
                            <img src="{{ asset('img/img-product/product-4.png') }}" alt="Gambar Produk Teh Botol Sosro"
                                class="w-full h-full object-cover rounded-lg">
                        </div>
                        <h3 class="font-bold text-lg text-jetblack text-center">Chitato</h3>
                        <button
                            class="w-full bg-tealmist hover:bg-tealmist/80 text-softivory font-semibold py-2.5 transition rounded-lg">
                            Lihat Detail
                        </button>
                    </div>
                </div>

                {{-- Pagination --}}
                <div class="flex items-center justify-center gap-8">
                    {{-- Previous Button --}}
                    <button
                        class="w-12 h-12 rounded-full bg-softivory text-[0.6rem] font-bold text-jetblack hover:softivory/60 transition shadow-sm flex items-center justify-center">
                        <i class="fa-solid fa-chevron-left text-jetblack text-lg"></i>
                    </button>
                    {{-- Next Button --}}
                    <button
                        class="w-12 h-12 rounded-full bg-softivory text-[0.6rem] font-bold text-jetblack hover:softivory/60 transition shadow-sm flex items-center justify-center">
                        <i class="fa-solid fa-chevron-right text-jetblack text-lg"></i>
                    </button>
                </div>
            </div>
        </section>

        {{-- Nutrition Calculator --}}
        <section id="nutrition-calculator" class="w-full bg-softivory py-20 px-6 lg:px-16 flex items-center">
            <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <div class="w-full flex justify-center lg:justify-start">
                    {{-- Illustration --}}
                    <div class="w-full max-w-125 aspect-square  rounded-2xl overflow-hidden "> <img
                            src="{{ asset('img/nutrition-calculator.png') }}" alt="Illustrasi Kalkulator Nutrisi NutriCare"
                            class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="flex flex-col gap-6 items-start">
                    {{-- Title --}}
                    <h2 class="text-4xl lg:text-4xl font-bold text-jetblack tracking-tight">
                        Cek Nutrisi Produk Anda
                    </h2>
                    {{-- Description --}}
                    <p class="text-lg text-jetblack font-medium leading-relaxed max-w-xl">
                        Gunakan kalkulator nutrisi untuk mengetahui estimasi kandungan gizi dari produk makanan dan minuman
                        kemasan. Fitur ini membantu Anda membuat pilihan konsumsi yang lebih sehat dan bijak
                    </p>
                    {{-- Button to Calculator --}}
                    <a href="#"
                        class="bg-tealmist hover:bg-tealmist/80 text-softivory font-semibold py-3 px-8 mt-2 transition duration-200 shadow-sm rounded-lg">
                        Coba Sekarang
                    </a>
                </div>
            </div>
        </section>
    </main>

@endsection