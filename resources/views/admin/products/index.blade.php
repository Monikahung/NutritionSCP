@extends('admin.layout')

@section('page-title', 'Nutrisi Produk')

@section('content')
    <div class="p-6 lg:p-8">

        <!-- Search -->
        <form method="GET" class="mb-6">
            <div class="flex gap-2">

                <div class="relative flex-1">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Pencarian..."
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:border-tealMist text-sm shadow-sm">

                    <div class="absolute left-4 top-1/2 -translate-y-1/2">
                        <svg width="18" height="18" fill="none" stroke="#6ea89e" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                    </div>

                </div>

                <input type="hidden" name="grade" value="{{ request('grade') }}">

                <button type="submit"
                    class="bg-tealMist text-white px-6 py-3 rounded-xl text-sm font-semibold hover:bg-tealMist/90">
                    Cari
                </button>

            </div>
        </form>

        <!-- Grade Filter -->
        <div class="mb-8">

            @php
                $grades = [
                    ['value' => '', 'label' => 'Semua', 'bg' => '#6ea89e', 'icon' => '★'],
                    ['value' => 'a', 'label' => 'Sangat Sesuai', 'bg' => '#6ea89e', 'icon' => 'A'],
                    ['value' => 'b', 'label' => 'Sesuai', 'bg' => '#a6d2c8', 'icon' => 'B'],
                    ['value' => 'e', 'label' => 'Buruk', 'bg' => '#dc2626', 'icon' => 'E'],
                ];
            @endphp

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                @foreach($grades as $g)

                    <a href="?grade={{ $g['value'] }}&q={{ request('q') }}"
                        class="bg-white rounded-xl p-4 flex flex-col items-center gap-3 hover:shadow-md transition border-2 {{ request('grade') == $g['value'] ? 'border-tealMist shadow-md' : 'border-transparent' }}">

                        <div class="w-14 h-14 rounded-xl flex items-center justify-center text-white font-bold text-xl"
                            style="background:{{ $g['bg'] }}">
                            {{ $g['icon'] }}
                        </div>

                        <span class="text-sm font-semibold text-jetBlack">
                            {{ $g['label'] }}
                        </span>

                    </a>

                @endforeach

            </div>
        </div>


        <!-- PRODUCT GRID -->
        <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5"></div>


        <!-- LOADING -->
        <div id="loading" class="text-center py-10">

            <div class="animate-spin w-8 h-8 border-4 border-gray-300 border-t-teal-500 rounded-full mx-auto">
            </div>

            <p class="text-gray-400 mt-2 text-sm">Memuat produk...</p>

        </div>


        <!-- PAGINATION -->
        <div id="pagination" class="flex justify-center gap-3 mt-8"></div>


    </div>


    <script>

        async function loadProducts() {

            const params = new URLSearchParams(window.location.search);

            const res = await fetch('/admin/api/products?' + params.toString());

            const data = await res.json();

            const grid = document.getElementById('productGrid');
            const loading = document.getElementById('loading');
            const pagination = document.getElementById('pagination');

            loading.style.display = 'none';

            grid.innerHTML = '';
            pagination.innerHTML = '';

            if (!data.products || data.products.length === 0) {

                grid.innerHTML = `
                    <div class="col-span-3 text-center py-20 text-gray-500">
                    Tidak ada produk ditemukan
                    </div>
                    `;

                return;

            }

            data.products.forEach(product => {

                const gradeColors = {
                    a: '#6ea89e',
                    b: '#a6d2c8',
                    c: '#fbbf24',
                    d: '#f97316',
                    e: '#dc2626'
                };

                const grade = product.nutrition_grades ?? '';
                const color = gradeColors[grade] ?? '#6b7280';

                const card = `

                    <div class="bg-white rounded-xl overflow-hidden border border-gray-100 hover:shadow-lg transition">

                    <div class="relative">

                    <div class="bg-gray-200 aspect-square overflow-hidden">

                    ${product.image_url ?

                        `<img src="${product.image_url}" class="w-full h-full object-cover">`

                        :

                        `<div class="flex items-center justify-center h-full text-gray-400 font-semibold">Gambar Produk</div>`

                    }

                    </div>

                    ${grade ?

                        `<div class="absolute top-3 left-3 w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold"
                    style="background:${color}">
                    ${grade.toUpperCase()}
                    </div>`

                        : ``}

                    </div>

                    <div class="p-4">

                    <h3 class="font-semibold text-center text-sm line-clamp-2">
                    ${product.product_name}
                    </h3>

                    ${product.brands ?

                        `<p class="text-gray-400 text-xs text-center mb-3">${product.brands}</p>`

                        : ``}
                            <a href="/admin/produk/${product.code}"
                                        class="block w-full text-center bg-gray-600 hover:bg-gray-700 text-white py-2 rounded-lg text-sm font-medium">
                                        Lihat Detail
                                        </a>

                    </div>

                    </div>

                    `;

                grid.insertAdjacentHTML('beforeend', card);

            });

        }

        loadProducts();

    </script>

@endsection