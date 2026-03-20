<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NutriCare - Admin')</title>

    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="font-jakarta-sans bg-gray-100">

    <div class="flex h-screen overflow-hidden">

        <!-- Overlay (mobile) -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 hidden z-40 md:hidden" onclick="closeSidebar()">
        </div>

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed md:static z-50 w-64 bg-teal-700 text-white flex flex-col h-full
        transform -translate-x-full md:translate-x-0 transition-transform duration-200">

            <!-- Logo -->
            <div class="p-6 border-b border-teal-600 relative">

                <div class="flex items-center gap-3">
                    {{-- Logo --}}
                    <div class="w-8.5 h-8.5">
                        <img src="{{ asset('img/favicon.png') }}" alt="Logo NutriCare"
                            class="w-full h-full object-cover">
                    </div>
                    <span class="text-xl font-bold">NutriCare</span>
                </div>

                <!-- close mobile -->
                <button onclick="closeSidebar()" class="absolute right-4 top-6 md:hidden text-white">
                    <i class="fas fa-times text-lg"></i>
                </button>

            </div>

            <!-- Menu -->
            <nav class="flex-1 px-4 py-6">

                <ul class="space-y-2">

                    <li>
                        <a href="{{ route('dashboardadmin') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-600 transition
                        {{ request()->is('admin') ? 'bg-teal-500' : '' }}">
                            <i class="fas fa-home w-5"></i>
                            Beranda
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('aboutus') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-600 transition
                        {{ request()->is('admin/aboutus') ? 'bg-teal-500' : '' }}">
                            <i class="fas fa-circle-info w-5"></i>
                            Tentang Kami
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-600 transition
                        {{ request()->is('admin/produk*') ? 'bg-teal-500' : '' }}">
                            <i class="fas fa-bowl-food w-5"></i>
                            Nutrisi Produk
                        </a>
                    </li>
                    {{-- Artikel --}}
                    {{-- <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-600 transition
                        {{ request()->is('admin/articles*') ? 'bg-teal-500' : '' }}">
                            <i class="fas fa-newspaper w-5"></i>
                            Artikel
                        </a>
                    </li> --}}

                </ul>

            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-teal-600">

                <form method="POST" action="/logout">
                    @csrf

                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-gray-900 hover:bg-gray-800 transition">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        Keluar
                    </button>

                </form>

            </div>

        </aside>


        <!-- CONTENT AREA -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- Mobile Topbar -->
            <header class="md:hidden bg-teal-700 text-white flex items-center gap-4 px-4 py-3">

                <button onclick="openSidebar()">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <span class="font-bold text-lg">
                    NutriCare
                </span>

            </header>


            <!-- Desktop Headbar -->
            <header class="hidden md:flex items-center justify-between bg-white shadow px-8 py-4">

                <div>
                    <h2 class="text-3xl font-bold text-gray-800 py-2">
                        @yield('page-title', 'Dashboard')
                    </h2>
                </div>

                {{-- <div class="flex items-center gap-5">

                    <i class="fas fa-bell text-gray-500"></i>

                    <div class="w-9 h-9 bg-teal-600 rounded-full flex items-center justify-center text-white font-bold">
                        A
                    </div>

                </div> --}}

            </header>


            <!-- MAIN -->
            <main class="flex-1 overflow-y-auto p-6 md:p-8">

                @yield('content')

            </main>

        </div>

    </div>


    <script>

        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.remove('hidden');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.add('hidden');
        }

    </script>

</body>

</html>