@extends('admin.layout')
@section('title', 'Beranda - NutriCare Admin')

@section('content')
<div>
    <h1 class="text-3xl font-bold text-jetblack mb-6">Beranda</h1>

    <!-- Profile Card -->
    <div class="bg-teal-700 rounded-2xl p-6 mb-5 text-white shadow-md">
        <div class="flex flex-col md:flex-row gap-6">

            <!-- Left: Branding + description + button -->
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-teal-700 font-bold text-xl flex-shrink-0">
                        N
                    </div>
                    <h2 class="text-2xl font-bold">NutriCare</h2>
                </div>
                <p class="text-teal-100 text-base leading-relaxed mb-5">
                    Platform edukasi nutrisi yang membantu masyarakat memahami kandungan gizi pada produk makanan dan minuman kemasan.
                </p>
                <button class="inline-flex items-center gap-2 bg-white text-teal-700 font-semibold text-sm px-5 py-2.5 rounded-lg hover:bg-teal-50 transition-colors">
                    <i class="fas fa-pen text-xs"></i>
                    Ubah Profil
                </button>
            </div>

            <!-- Right: Contact info -->
            <div class="flex flex-col gap-3 md:w-64">
                <div class="flex items-center gap-3 text-base">
                    <div class="w-9 h-9 bg-teal-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-envelope text-sm"></i>
                    </div>
                    <span class="text-teal-100">nutricare@gmail.com</span>
                </div>
                <div class="flex items-center gap-3 text-base">
                    <div class="w-9 h-9 bg-teal-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-phone text-sm"></i>
                    </div>
                    <span class="text-teal-100">0812-3456-7890</span>
                </div>
                <div class="flex items-center gap-3 text-base">
                    <div class="w-9 h-9 bg-teal-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fab fa-instagram text-sm"></i>
                    </div>
                    <span class="text-teal-100">nutriCare_</span>
                </div>
                <div class="flex items-center gap-3 text-base">
                    <div class="w-9 h-9 bg-teal-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fab fa-twitter text-sm"></i>
                    </div>
                    <span class="text-teal-100">nutriCare_</span>
                </div>
            </div>

        </div>
    </div>

    <!-- Banner Card -->
    <div class="bg-teal-600 rounded-2xl overflow-hidden shadow-md text-white">
        <div class="flex flex-col sm:flex-row">

            <!-- Left: Illustration placeholder -->
            <div class="sm:w-64 flex-shrink-0 bg-teal-500/40 flex items-center justify-center min-h-48 p-6">
                <div class="text-center">
                    <div class="w-20 h-20 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-image text-white/60 text-3xl"></i>
                    </div>
                    <span class="text-teal-200 text-sm font-medium">Ilustrasi Banner</span>
                </div>
            </div>

            <!-- Right: Text + button -->
            <div class="flex-1 p-6 flex flex-col justify-center">
                <h3 class="text-xl font-bold leading-snug mb-3">
                    Kenali Nutrisi, Pilih Produk Makanan Lebih Sehat
                </h3>
                <p class="text-teal-100 text-base leading-relaxed mb-5">
                    Pelajari kandungan gizi pada produk makanan kemasan, gunakan kalkulator nutrisi, dan temukan berbagai artikel untuk membantu Anda membuat pilihan makanan yang lebih sehat.
                </p>
                <div>
                    <button class="inline-flex items-center gap-2 bg-white text-teal-700 font-semibold text-sm px-5 py-2.5 rounded-lg hover:bg-teal-50 transition-colors">
                        <i class="fas fa-pen text-xs"></i>
                        Ubah Banner
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
