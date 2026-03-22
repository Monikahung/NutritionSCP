<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - @yield('title')</title>

    {{-- Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Alpine.js --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">

    {{-- Cache Control --}}
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    {{-- Menyembunyikan elemen Alpine sebelum dimuat sepenuhnya agar tidak berkedip --}}
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body id="home" class="font-jakarta-sans antialiased text-jetblack bg-softivory flex flex-col min-h-screen">

    {{-- Header (Ditambahkan x-data untuk Alpine.js) --}}
    <header x-data="{ mobileMenuOpen: false }" class="w-full bg-softivory shadow-lg shadow-jetblack/10 shrink-0 relative z-50">
        
        {{-- Top Bar Container --}}
        <div class="flex items-center justify-between px-6 py-4 lg:px-12 relative z-50 bg-softivory">
            <div class="flex items-center gap-3">
                {{-- Logo --}}
                <div class="w-8.5 h-8.5">
                    <img src="{{ asset('img/nutricare-logo.png') }}" alt="Logo NutriCare" class="w-full h-full object-cover">
                </div>
                {{-- Brand Name --}}
                <span class="text-2xl font-semibold tracking-tight text-jetblack font-poppins">NutriCare</span>
            </div>

            {{-- Desktop Navigation (Tetap tersembunyi di Mobile) --}}
            <nav class="hidden md:flex items-center gap-12 font-semibold text-jetblack">
                <a href="{{ route('homepublic') }}#home" class="text-lg hover:text-tealmist transition duration-200">Beranda</a>
                <a href="{{ route('homepublic') }}#about-us" class="text-lg hover:text-tealmist transition duration-200">Tentang Kami</a>
                <a href="{{ route('homepublic') }}#nutrition-products" class="text-lg hover:text-tealmist transition duration-200">Nutrisi Produk</a>
                <a href="{{ route('homepublic') }}#nutrition-calculator" class="text-lg hover:text-tealmist transition duration-200">Kalkulator</a>
            </nav>

            {{-- Right Section: Auth Button & Mobile Toggle --}}
            <div class="flex items-center gap-4">
                {{-- Auth Button --}}
                <a href="{{ route('login') }}" class="bg-tealmist hover:bg-tealmist/80 text-softivory px-3 py-2.5 flex items-center justify-center transition duration-200 rounded-md">
                    <i class="fa-solid fa-right-to-bracket"></i>
                </a>

                {{-- Hamburger Button (Hanya tampil di Mobile) --}}
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-jetblack text-2xl focus:outline-none flex items-center justify-center w-8 h-8">
                    {{-- Ikon berubah silang/garis tiga otomatis --}}
                    <i class="fa-solid fa-bars" x-show="!mobileMenuOpen"></i>
                    <i class="fa-solid fa-xmark" x-show="mobileMenuOpen" x-cloak></i>
                </button>
            </div>
        </div>

        {{-- Mobile Navigation Dropdown --}}
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-5"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-5"
             @click.outside="mobileMenuOpen = false"
             class="md:hidden absolute top-full left-0 w-full bg-softivory shadow-lg border-t border-gray-200 flex flex-col font-semibold text-jetblack z-40"
             x-cloak>
            
            {{-- Saat menu diklik, menu otomatis tertutup (@click="mobileMenuOpen = false") --}}
            <a href="{{ route('homepublic') }}#home" @click="mobileMenuOpen = false" class="px-6 py-4 border-b border-gray-200 hover:bg-tealmist/10 hover:text-tealmist transition">Beranda</a>
            <a href="{{ route('homepublic') }}#about-us" @click="mobileMenuOpen = false" class="px-6 py-4 border-b border-gray-200 hover:bg-tealmist/10 hover:text-tealmist transition">Tentang Kami</a>
            <a href="{{ route('homepublic') }}#nutrition-products" @click="mobileMenuOpen = false" class="px-6 py-4 border-b border-gray-200 hover:bg-tealmist/10 hover:text-tealmist transition">Nutrisi Produk</a>
            <a href="{{ route('homepublic') }}#nutrition-calculator" @click="mobileMenuOpen = false" class="px-6 py-4 hover:bg-tealmist/10 hover:text-tealmist transition">Kalkulator</a>
        </div>

    </header>

    {{-- Main Content --}}
    @yield('content')

    {{-- Footer --}}
    <footer class="bg-tealmist py-16 px-6 lg:px-12 border-t border-gray-200 shrink-0">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="flex flex-col gap-5">
                <div class="flex items-center gap-3">
                    <div class="w-8.5 h-8.5">
                        <img src="{{ asset('img/nutricare-logo.png') }}" alt="Logo NutriCare" class="w-full h-full object-cover">
                    </div>
                    <span class="text-2xl font-semibold tracking-tight text-jetblack font-poppins">NutriCare</span>
                </div>
                <p class="text-jetblack font-medium leading-relaxed max-w-sm">
                    Platform edukasi nutrisi yang membantu masyarakat memahami kandungan gizi pada produk makanan dan minuman kemasan.
                </p>
            </div>

            <div class="flex md:justify-center w-full">
                <div class="flex flex-col gap-4 font-semibold text-jetblack min-w-fit">
                    <a href="{{ route('homepublic') }}#home" class="text-lg hover:text-jetblack/60 transition duration-200 w-fit">Beranda</a>
                    <a href="{{ route('homepublic') }}#about-us" class="text-lg hover:text-jetblack/60 transition duration-200 w-fit">Tentang Kami</a>
                    <a href="{{ route('homepublic') }}#nutrition-products" class="text-lg hover:text-jetblack/60 transition duration-200 w-fit">Nutrisi Produk</a>
                    <a href="{{ route('homepublic') }}#nutrition-calculator" class="text-lg hover:text-jetblack/60 transition duration-200 w-fit">Kalkulator</a>
                </div>
            </div>

            <div class="flex gap-4 md:justify-end ">
                <a href="mailto:nutricare@gmail.com" class="w-10 h-10 bg-softivory hover:bg-softivory/60 transition duration-200 flex items-center justify-center text-tealmist rounded-lg border border-aquabreeze">
                    <i class="fa-solid fa-envelope text-xl"></i>
                </a>
                <a href="https://wa.me/6281234567890" class="w-10 h-10 bg-softivory hover:bg-softivory/60 transition duration-200 flex items-center justify-center text-tealmist rounded-lg border border-aquabreeze">
                    <i class="fa-brands fa-whatsapp text-xl"></i>
                </a>
                <a href="tel:+6281234567890" class="w-10 h-10 bg-softivory hover:bg-softivory/60 transition duration-200 flex items-center justify-center text-tealmist rounded-lg border border-aquabreeze">
                    <i class="fa-solid fa-phone text-xl"></i>
                </a>
                <a href="https://www.instagram.com/nutricare" class="w-10 h-10 bg-softivory hover:bg-softivory/60 transition duration-200 flex items-center justify-center text-tealmist rounded-lg border border-aquabreeze">
                    <i class="fa-brands fa-instagram text-xl"></i>
                </a>
                <a href="https://www.facebook.com/nutricare" class="w-10 h-10 bg-softivory hover:bg-softivory/60 transition duration-200 flex items-center justify-center text-tealmist rounded-lg border border-aquabreeze">
                    <i class="fa-brands fa-facebook-f text-xl"></i>
                </a>
            </div>
        </div>
    </footer>

</body>
</html>