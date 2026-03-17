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
                    <div
                        class="w-10 h-10 bg-white rounded-md flex items-center justify-center text-teal-700 font-bold text-2xl">
                        N
                    </div>
                    <span class="font-poppins text-xl font-bold">NutriCare</span>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6">
                <ul class="space-y-3 mt-3">

                    <li>
                        <a href="/admin"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-600 {{ request()->is('admin') ? 'bg-teal-500' : '' }}">
                            <i class="fas fa-home w-5"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="/admin/profile"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-600 {{ request()->is('admin/profile') ? 'bg-teal-500' : '' }}">
                            <i class="fas fa-circle-info w-5"></i>
                            <span>Tentang Kami</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/produk"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-600 {{ request()->is('admin/banner') ? 'bg-teal-500 text-gray-900' : '' }}">
                            <i class="fas fa-bowl-food"></i>
                            <span>Nutrisi Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/articles"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-600 transition {{ request()->is('admin/articles*') ? 'bg-teal-500 text-gray-900' : '' }}">
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
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-jetblack text-white hover:bg-[#1b2327] transition">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>



        </aside>

        <!-- Area konten utama -->
        {{-- <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Topbar / Header -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center gap-4">
                        <h1 class="text-xl font-semibold text-gray-800">
                            @yield('page-title', 'Dashboard Admin')
                        </h1>
                    </div>

                    <!-- Info admin (kanan atas) -->
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="font-medium text-gray-800">{{ auth()->user()->name ?? 'Admin' }}</p>
                            <p class="text-sm text-gray-500">{{ auth()->user()->email ?? 'admin@nutricare.com' }}</p>
                        </div>
                        <a href="/admin/profile"
                            class="w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center hover:bg-teal-700 transition">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Isi konten (yield) -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
                @yield('content')
            </main>

        </div> --}}
        <div class="flex-1 p-8 overflow-y-auto">

            @yield('content')
        
        </div>
    </div>

</body>

</html>