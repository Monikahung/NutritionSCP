@extends('admin.layout')
@section('title', 'Tentang Kami')

@section('content')
<div class="p-6 lg:p-8 max-w-4xl">
    <h1 class="text-2xl font-bold text-jetBlack mb-6">Tentang Kami</h1>

    <div class="bg-white rounded-xl p-6 mb-5 shadow-sm">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-tealMist rounded flex items-center justify-center">
                <svg width="20" height="20" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-jetBlack">NutriCare</h2>
        </div>
        <p class="text-gray-600 leading-relaxed text-sm">
            NutriCare adalah platform edukasi nutrisi yang didedikasikan untuk membantu masyarakat Indonesia memahami kandungan gizi pada produk makanan dan minuman kemasan. Kami percaya bahwa dengan pengetahuan yang tepat, setiap orang dapat membuat keputusan yang lebih baik untuk kesehatan mereka.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-bold text-jetBlack mb-3">Visi Kami</h2>
            <p class="text-gray-600 text-sm leading-relaxed">
                Menjadi platform terdepan dalam edukasi nutrisi di Indonesia, memberdayakan masyarakat untuk membuat pilihan makanan yang lebih sehat.
            </p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-bold text-jetBlack mb-3">Misi Kami</h2>
            <ul class="text-gray-600 text-sm space-y-2">
                <li class="flex items-start gap-2">
                    <span class="w-2 h-2 bg-tealMist rounded-full mt-1.5 flex-shrink-0"></span>
                    Menyediakan informasi nutrisi yang akurat
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-2 h-2 bg-tealMist rounded-full mt-1.5 flex-shrink-0"></span>
                    Meningkatkan kesadaran tentang label nutrisi
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-2 h-2 bg-tealMist rounded-full mt-1.5 flex-shrink-0"></span>
                    Mendukung gaya hidup sehat melalui edukasi
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-2 h-2 bg-tealMist rounded-full mt-1.5 flex-shrink-0"></span>
                    Memfasilitasi akses data nutrisi produk kemasan
                </li>
            </ul>
        </div>
    </div>

    <!-- Nutri-Score Guide -->
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h2 class="text-lg font-bold text-jetBlack mb-4">Sistem Nutri-Score</h2>
        <p class="text-gray-600 text-sm leading-relaxed mb-5">
            Nutri-Score adalah sistem penilaian nutrisi yang menggunakan skala dari A (terbaik) hingga E (terburuk). Sistem ini mempertimbangkan energi, gula, lemak jenuh, natrium, serta protein, serat, dan kandungan buah-buahan.
        </p>
        <div class="flex flex-wrap gap-4">
            @foreach([
                ['A','Sangat Sesuai','#6ea89e'],
                ['B','Sesuai','#a6d2c8'],
                ['C','Sedang','#fbbf24'],
                ['D','Kurang','#f97316'],
                ['E','Buruk','#dc2626'],
            ] as [$g,$l,$c])
            <div class="flex flex-col items-center gap-2">
                <div class="w-14 h-14 rounded-xl flex items-center justify-center text-white font-bold text-2xl shadow"
                     style="background-color: {{ $c }}">{{ $g }}</div>
                <span class="text-xs text-gray-600 text-center font-medium">{{ $l }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
