@extends('admin.layout')

@section('page-title', 'Nutrisi Produk')

@section('content')
    <div class="p-6 lg:p-8">

        <!-- SEARCH + FILTER -->
        <form method="GET" class="mb-6">
            <div class="flex gap-2 items-center">

                <!-- SEARCH -->
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

                <!-- FILTER DROPDOWN -->
                <div class="relative" id="gradeDropdown">

                    <!-- BUTTON -->
                    <button type="button" onclick="toggleDropdown()"
                        class="flex items-center gap-2 px-4 py-3 rounded-xl border border-gray-200 bg-white shadow-sm text-sm">

                        <span id="selectedBadge"
                            class="w-6 h-6 flex items-center justify-center rounded-full text-white text-xs font-bold"
                            style="background:#6ea89e">
                            ★
                        </span>

                        <span id="selectedText">Semua</span>
                    </button>

                    <!-- DROPDOWN -->
                    <div id="dropdownMenu"
                        class="hidden absolute mt-2 w-48 bg-white border rounded-xl shadow-lg overflow-hidden z-50">

                        @php
                            $grades = [
                                ['value' => '', 'label' => 'Semua', 'color' => '#6ea89e', 'icon' => '★'],
                                ['value' => 'a', 'label' => 'A - Sangat Sesuai', 'color' => '#6ea89e', 'icon' => 'A'],
                                ['value' => 'b', 'label' => 'B - Sesuai', 'color' => '#a6d2c8', 'icon' => 'B'],
                                ['value' => 'c', 'label' => 'C - Sedang', 'color' => '#fbbf24', 'icon' => 'C'],
                                ['value' => 'd', 'label' => 'D - Kurang', 'color' => '#f97316', 'icon' => 'D'],
                                ['value' => 'e', 'label' => 'E - Buruk', 'color' => '#dc2626', 'icon' => 'E'],
                            ];
                        @endphp

                        @foreach($grades as $g)
                            <div onclick="selectGrade('{{ $g['value'] }}', '{{ $g['label'] }}', '{{ $g['color'] }}', '{{ $g['icon'] }}')"
                                class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 cursor-pointer">

                                <span class="w-6 h-6 flex items-center justify-center rounded-full text-white text-xs font-bold"
                                    style="background: {{ $g['color'] }}">
                                    {{ $g['icon'] }}
                                </span>

                                <span class="text-sm">{{ $g['label'] }}</span>
                            </div>
                        @endforeach

                    </div>

                    <!-- HIDDEN INPUT -->
                    <input type="hidden" name="grade" id="gradeInput" value="{{ request('grade') }}">

                </div>

                <button type="submit" class="bg-tealMist text-white px-6 py-3 rounded-xl text-sm font-semibold">
                    Cari
                </button>

            </div>
        </form>

        <!-- GRID -->
        <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5"></div>

        <!-- LOADING -->
        <div id="loading" class="text-center py-10 hidden">
            <div class="animate-spin w-8 h-8 border-4 border-gray-300 border-t-teal-500 rounded-full mx-auto"></div>
            <p class="text-gray-400 mt-2 text-sm">Memuat produk...</p>
        </div>

        <!-- PAGINATION -->
        <div id="pagination" class="flex flex-wrap justify-center gap-2 mt-8"></div>

    </div>

    <script>
        let currentPage = 1;

        async function loadProducts(page = 1) {

            currentPage = page;

            const params = new URLSearchParams(window.location.search);
            params.set('page', page);

            const grid = document.getElementById('productGrid');
            const loading = document.getElementById('loading');
            const pagination = document.getElementById('pagination');

            loading.classList.remove('hidden');

            try {

                const res = await fetch('/admin/api/products?' + params.toString());

                if (!res.ok) {
                    grid.innerHTML = `<div class="text-center py-20 text-red-400">API error</div>`;
                    return;
                }

                const data = await res.json();

                grid.innerHTML = '';
                pagination.innerHTML = '';

                const gradeColors = {
                    a: '#6ea89e',
                    b: '#a6d2c8',
                    c: '#fbbf24',
                    d: '#f97316',
                    e: '#dc2626'
                };

                const gradeLabels = {
                    a: 'Sangat Sesuai',
                    b: 'Sesuai',
                    c: 'Sedang',
                    d: 'Kurang',
                    e: 'Buruk'
                };

                let products = data.products;

                const selectedGrade = new URLSearchParams(window.location.search).get('grade');

                if (selectedGrade) {
                    products = products.filter(p =>
                        p.nutrition_grades?.toLowerCase() === selectedGrade.toLowerCase()
                    );
                }

                if (!products || products.length === 0) {
                    grid.innerHTML = `<div class="col-span-3 text-center py-20">Tidak ada produk</div>`;
                    return;
                }

                products.forEach(product => {

                    const grade = (product.nutrition_grades || '').toLowerCase();

                    if (!grade || grade === 'unknown') return;

                    const color = gradeColors[grade] ?? '#6b7280';

                    const card = `
                                    <div class="bg-white rounded-xl overflow-hidden border hover:shadow-lg transition">

                                        <div class="relative">

                                            <div class="bg-gray-200 aspect-square">
                                                ${product.image_url
                            ? `<img src="${product.image_url}" class="w-full h-full object-cover">`
                            : `<div class="flex items-center justify-center h-full text-gray-400">No Image</div>`
                        }
                                            </div>

                                            <!-- BADGE -->
                                            <div class="absolute top-3 left-3 flex items-center gap-2 bg-white px-2 py-1 rounded-full shadow border border-white text-xs font-semibold">

                                                <span class="w-6 h-6 flex items-center justify-center rounded-full text-white text-[10px] font-bold"
                                                    style="background:${color}">
                                                    ${grade.toUpperCase()}
                                                </span>

                                                <span style="color:${color}">
                                                    ${gradeLabels[grade]}
                                                </span>

                                            </div>

                                        </div>

                                        <div class="p-4">
                                            <h3 class="text-sm font-semibold text-center line-clamp-2">
                                                ${product.product_name}
                                            </h3>

                                            ${product.brands
                            ? `<p class="text-gray-400 text-xs text-center mb-3">${product.brands}</p>`
                            : ''
                        }

                                            <a href="/admin/produk/${product.code}"
                                                class="block text-center bg-gray-600 hover:bg-gray-700 text-white py-2 rounded-lg text-sm">
                                                Lihat Detail
                                            </a>
                                        </div>

                                    </div>
                                `;

                    grid.insertAdjacentHTML('beforeend', card);
                });

                // PAGINATION
                const totalPages = data.totalPages || 1;

                let start = Math.max(1, page - 2);
                let end = Math.min(totalPages, page + 2);

                if (page > 1) {
                    pagination.innerHTML += `
                                    <button onclick="loadProducts(${page - 1})"
                                        class="px-4 py-2 bg-white border rounded-lg hover:bg-tealMist hover:text-white">
                                        Prev
                                    </button>`;
                }

                for (let i = start; i <= end; i++) {
                    pagination.innerHTML += `
                                    <button onclick="loadProducts(${i})"
                                        class="px-4 py-2 rounded-lg font-medium
                                        ${i === page
                            ? 'bg-tealMist text-white shadow-md'
                            : 'bg-white border border-gray-300 text-gray-700 hover:bg-tealMist hover:text-white'}">
                                        ${i}
                                    </button>`;
                }

                if (page < totalPages) {
                    pagination.innerHTML += `
                                    <button onclick="loadProducts(${page + 1})"
                                        class="px-4 py-2 bg-white border rounded-lg hover:bg-tealMist hover:text-white">
                                        Next
                                    </button>`;
                }

            } catch (err) {
                console.error(err);
                grid.innerHTML = `<div class="text-center py-20 text-red-400">API error</div>`;
            }

            loading.classList.add('hidden');
        }

        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('hidden');
        }

        function selectGrade(value, label, color, icon) {

            document.getElementById('gradeInput').value = value;
            document.getElementById('selectedText').innerText = label;

            const badge = document.getElementById('selectedBadge');
            badge.innerText = icon;
            badge.style.background = color;

            document.getElementById('dropdownMenu').classList.add('hidden');

            // ✅ UX FEEDBACK LANGSUNG
            const grid = document.getElementById('productGrid');
            const loading = document.getElementById('loading');

            grid.innerHTML = '';
            loading.classList.remove('hidden');

            // logic filter
            currentPage = 1;
            const params = new URLSearchParams(window.location.search);

            if (value === '') {
                params.delete('grade');
            } else {
                params.set('grade', value);
            }

            params.set('page', 1);

            const newUrl = window.location.pathname + '?' + params.toString();
            window.history.pushState({}, '', newUrl);

            loadProducts(1);
        }

        // INIT
        loadProducts(1);
    </script>
@endsection