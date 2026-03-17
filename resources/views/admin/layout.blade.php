<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NutriCare - Admin')</title>
    <!-- Tailwind --> @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="font-jakarta-sans bg-gray-100 leading-normal tracking-normal">

    <div class="flex h-screen">

        <!-- SIDEBAR kiri -->
        <aside class="w-64 bg-teal-700 text-white flex flex-col">

            <div class="p-6 border-b border-teal-600">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-md flex items-center justify-center text-teal-700 font-bold text-2xl">
                        N
                    </div>
                    <span class="font-poppins text-xl font-bold">NutriCare</span>
                </div>
                <!-- Close button (mobile only) -->
                <button onclick="closeSidebar()" class="md:hidden text-white/80 hover:text-white p-1" aria-label="Tutup menu">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <nav class="flex-1 px-4 py-6">
                <ul class="space-y-3 mt-3">

                    <li>
                        <a href="{{ route('dashboardadmin') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-600 transition-colors {{ request()->is('admin') ? 'bg-teal-500' : '' }}">
                            <i class="fas fa-home w-5"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('aboutus') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-600 transition-colors {{ request()->is('admin/aboutus') ? 'bg-teal-500' : '' }}">
                            <i class="fas fa-circle-info w-5"></i>
                            <span>Tentang Kami</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-600 transition-colors {{ request()->is('admin/produk*') ? 'bg-teal-500' : '' }}">
                            <i class="fas fa-bowl-food w-5"></i>
                            <span>Nutrisi Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-600 transition-colors {{ request()->is('admin/articles*') ? 'bg-teal-500' : '' }}">
                            <i class="fas fa-newspaper w-5"></i>
                            <span>Artikel</span>
                        </a>
                    </li>

                </ul>
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-teal-400">
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-jetblack text-white hover:bg-[#1b2327] transition-colors">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>

        </aside>

        <!-- Area konten utama -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            <!-- Mobile topbar -->
            <header class="md:hidden bg-teal-700 text-white flex items-center gap-4 px-4 py-3 shadow-sm flex-shrink-0">
                <button onclick="openSidebar()" class="text-white p-1" aria-label="Buka menu">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <span class="font-poppins font-bold text-lg">NutriCare</span>
            </header>

            <main class="flex-1 p-4 md:p-8 overflow-y-auto">
                @yield('content')
            </main>

        </div>
    </div>

    <script>
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>

</body>

</html>
