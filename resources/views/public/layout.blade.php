<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Beranda</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="font-jakarta-sans antialiased text-jetblack bg-white flex flex-col min-h-screen">

    <header class="flex items-center justify-between px-6 py-4 bg-[#F8F9FA] lg:px-12 shadow-sm shrink-0">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-tealmist"></div>
            <span class="text-2xl font-bold tracking-tight text-jetblack">NutriCare</span>
        </div>

        <nav class="hidden md:flex items-center gap-12 font-semibold text-jetblack">
            <a href="#" class="hover:text-tealmist transition duration-200">Beranda</a>
            <a href="#" class="hover:text-tealmist transition duration-200">Tentang Kami</a>
            <a href="#" class="hover:text-tealmist transition duration-200">Nutrisi Produk</a>
            <a href="#" class="hover:text-tealmist transition duration-200">Kalkulator</a>
            <a href="#" class="hover:text-tealmist transition duration-200">Artikel</a>
        </nav>

        <div>
            <a href="#" class="bg-tealmist hover:bg-tealmist/80 text-white text-[0.65rem] md:text-xs font-semibold px-3 py-2 flex flex-col items-center justify-center transition duration-200">
                <span>Login/Register</span>
            </a>
        </div>
    </header>

    @yield('content')


    <footer class="bg-white py-16 px-6 lg:px-12 border-t border-gray-200 shrink-0">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="flex flex-col gap-5">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-tealmist"></div>
                    <span class="text-2xl font-bold tracking-tight text-jetblack">NutriCare</span>
                </div>
                <p class="text-jetblack/80 font-medium leading-relaxed max-w-sm">
                    Platform edukasi nutrisi yang membantu masyarakat memahami kandungan gizi pada produk makanan dan minuman kemasan.
                </p>
            </div>

            <div class="flex flex-col gap-4 font-semibold text-jetblack">
                <a href="#" class="hover:text-tealmist transition duration-200 w-fit">Beranda</a>
                <a href="#" class="hover:text-tealmist transition duration-200 w-fit">Tentang Kami</a>
                <a href="#" class="hover:text-tealmist transition duration-200 w-fit">Nutrisi Produk</a>
                <a href="#" class="hover:text-tealmist transition duration-200 w-fit">Kalkulator</a>
                <a href="#" class="hover:text-tealmist transition duration-200 w-fit">Artikel</a>
            </div>

            <div class="flex gap-4 md:justify-end">
                <a href="#" class="w-10 h-10 bg-tealmist hover:bg-tealmist/80 transition duration-200 flex items-center justify-center text-white"></a>
                <a href="#" class="w-10 h-10 bg-tealmist hover:bg-tealmist/80 transition duration-200 flex items-center justify-center text-white"></a>
                <a href="#" class="w-10 h-10 bg-tealmist hover:bg-tealmist/80 transition duration-200 flex items-center justify-center text-white"></a>
                <a href="#" class="w-10 h-10 bg-tealmist hover:bg-tealmist/80 transition duration-200 flex items-center justify-center text-white"></a>
            </div>
        </div>
    </footer>

</body>
</html>