<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Beranda</title>

    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
</head>

<body id="home" class="font-jakarta-sans antialiased text-jetblack bg-softivory flex flex-col min-h-screen">

    {{-- Header --}}
    <header class="flex items-center justify-between px-6 py-4 bg-softivory lg:px-12 shadow-sm shrink-0">
        <div class="flex items-center gap-3">
            {{-- Logo --}}
            <div class="w-8.5 h-8.5">
                <img src="{{ asset('img/nutricare-logo.png') }}" alt="Logo NutriCare"
                    class="w-full h-full object-cover">
            </div>
            {{-- Brand Name --}}
            <span class="text-2xl font-semibold tracking-tight text-jetblack font-poppins">NutriCare</span>
        </div>

        {{-- Top Navigation --}}
        <nav class="hidden md:flex items-center gap-12 font-semibold text-jetblack">
            <a href="#home" class="text-lg hover:text-tealmist transition duration-200">Beranda</a>
            <a href="#about-us" class="text-lg hover:text-tealmist transition duration-200">Tentang Kami</a>
            <a href="#nutrition-products" class="text-lg hover:text-tealmist transition duration-200">Nutrisi Produk</a>
            <a href="#nutrition-calculator" class="text-lg hover:text-tealmist transition duration-200">Kalkulator</a>
        </nav>

        {{-- Auth Buttons --}}
        <div>
            <a href="#"
                class="bg-tealmist hover:bg-tealmist/80 text-softivory px-2.5 py-2.5 flex flex-col items-center justify-center transition duration-200 rounded-md">
                <i class="fa-solid fa-right-to-bracket"></i>
            </a>
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
                        {{-- Logo --}}
                        <img src="{{ asset('img/nutricare-logo.png') }}" alt="Logo NutriCare"
                            class="w-full h-full object-cover">
                    </div>
                    {{-- Brand Name --}}
                    <span class="text-2xl font-semibold tracking-tight text-jetblack font-poppins">NutriCare</span>
                </div>
                {{-- Brand Description --}}
                <p class="text-jetblack font-medium leading-relaxed max-w-sm">
                    Platform edukasi nutrisi yang membantu masyarakat memahami kandungan gizi pada produk makanan dan
                    minuman kemasan.
                </p>
            </div>

            {{-- Footer Navigation --}}
            <div class="flex md:justify-center w-full">
                <div class="flex flex-col gap-4 font-semibold text-jetblack min-w-fit">
                    <a href="#home" class="text-lg hover:text-jetblack/60 transition duration-200 w-fit">Beranda</a>
                    <a href="#about-us" class="text-lg hover:text-jetblack/60 transition duration-200 w-fit">Tentang
                        Kami</a>
                    <a href="#nutrition-products"
                        class="text-lg hover:text-jetblack/60 transition duration-200 w-fit">Nutrisi
                        Produk</a>
                    <a href="#nutrition-calculator"
                        class="text-lg hover:text-jetblack/60 transition duration-200 w-fit">Kalkulator</a>
                </div>
            </div>

            {{-- Social Media Links --}}
            <div class="flex gap-4 md:justify-end">
                <a href="mailto:nutricare@gmail.com"
                    class="w-10 h-10 bg-softivory hover:bg-softivory/60 transition duration-200 flex items-center justify-center text-tealmist rounded-lg border border-aquabreeze">
                    <i class="fa-solid fa-envelope text-xl"></i>
                </a>
                <a href="https://wa.me/6281234567890"
                    class="w-10 h-10 bg-softivory hover:bg-softivory/60 transition duration-200 flex items-center justify-center text-tealmist rounded-lg border border-aquabreeze">
                    <i class="fa-brands fa-whatsapp text-xl"></i>
                </a>
                <a href="tel:+6281234567890"
                    class="w-10 h-10 bg-softivory hover:bg-softivory/60 transition duration-200 flex items-center justify-center text-tealmist rounded-lg border border-aquabreeze">
                    <i class="fa-solid fa-phone text-xl"></i>
                </a>
                <a href="https://www.instagram.com/nutricare"
                    class="w-10 h-10 bg-softivory hover:bg-softivory/60 transition duration-200 flex items-center justify-center text-tealmist rounded-lg border border-aquabreeze">
                    <i class="fa-brands fa-instagram text-xl"></i>
                </a>
                <a href="https://www.facebook.com/nutricare"
                    class="w-10 h-10 bg-softivory hover:bg-softivory/60 transition duration-200 flex items-center justify-center text-tealmist rounded-lg border border-aquabreeze">
                    <i class="fa-brands fa-facebook-f text-xl"></i>
                </a>
            </div>
        </div>
    </footer>

</body>

</html>