@extends('admin.layout')
@section('content')
<div class="p-6 lg:p-8">
    <h1 class="text-2xl font-bold text-jetBlack mb-6">Nutrisi Produk</h1>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('products.index')}}" class="mb-6">
        <div class="flex gap-2">
            <div class="relative flex-1">
                <input type="text" name="q" value="{{ $query ?? '' }}"
                       placeholder="Pencarian..."
                       class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:border-tealMist text-sm shadow-sm">
                <div class="absolute left-4 top-1/2 -translate-y-1/2">
                    <svg width="18" height="18" fill="none" stroke="#6ea89e" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </div>
            </div>
            <input type="hidden" name="grade" value="{{ $grade ?? '' }}">
            <button type="submit"
                    class="bg-tealMist text-white px-6 py-3 rounded-xl font-semibold hover:bg-tealMist/90 transition-colors text-sm">
                Cari
            </button>
        </div>
    </form>

    <!-- Nutrition Grade Filter -->
    <div class="mb-8">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @php
                $grades = [
                    ['value' => '',  'label' => 'Semua',        'bg' => '#6ea89e', 'icon' => '★'],
                    ['value' => 'a', 'label' => 'Sangat Sesuai','bg' => '#6ea89e', 'icon' => 'A'],
                    ['value' => 'b', 'label' => 'Sesuai',       'bg' => '#a6d2c8', 'icon' => 'B'],
                    ['value' => 'e', 'label' => 'Buruk',        'bg' => '#dc2626', 'icon' => 'E'],
                ];
            @endphp
            @foreach($grades as $g)
            <a href="{{ route('products.index', array_merge(request()->except('grade','page'), ['grade' => $g['value'], 'q' => $query ?? ''])) }}"
               class="bg-white rounded-xl p-4 flex flex-col items-center gap-3 hover:shadow-md transition-all border-2 {{ ($grade ?? '') === $g['value'] ? 'border-tealMist shadow-md' : 'border-transparent' }}">
                <div class="w-14 h-14 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-sm"
                     style="background-color: {{ $g['bg'] }}">
                    {{ $g['icon'] }}
                </div>
                <span class="text-sm font-semibold text-jetBlack text-center">{{ $g['label'] }}</span>
            </a>
            @endforeach
        </div>
    </div>

    <!-- Product Grid -->
    @if(isset($error))
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-4 text-sm">
            {{ $error }}
        </div>
    @endif

    @if(empty($products))
        <div class="text-center py-20">
            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg width="28" height="28" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
            </div>
            <p class="text-gray-500 font-medium">Tidak ada produk ditemukan.</p>
            <a href="{{ route('products.index') }}" class="text-tealMist text-sm mt-2 inline-block hover:underline">Reset pencarian</a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($products as $product)
            <div class="bg-white rounded-xl overflow-hidden hover:shadow-lg transition-shadow border border-gray-100">
                <div class="relative">
                    <div class="bg-gray-200 aspect-square overflow-hidden">
                        @if(!empty($product['image_url']))
                            <img src="{{ $product['image_url'] }}"
                                 alt="{{ $product['product_name'] }}"
                                 class="w-full h-full object-cover"
                                 onerror="this.style.display='none';this.parentElement.innerHTML+='<div class=\'flex items-center justify-center h-full text-gray-400 font-semibold text-lg\'>Gambar Produk</div>'">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400 font-semibold text-lg">Gambar Produk</div>
                        @endif
                    </div>
                    @if(!empty($product['nutrition_grades']))
                    @php
                        $gradeColors = ['a'=>'#6ea89e','b'=>'#a6d2c8','c'=>'#fbbf24','d'=>'#f97316','e'=>'#dc2626'];
                        $gc = $gradeColors[strtolower($product['nutrition_grades'])] ?? '#6b7280';
                    @endphp
                    <div class="absolute top-3 left-3 w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-md"
                         style="background-color: {{ $gc }}">
                        {{ strtoupper($product['nutrition_grades']) }}
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-jetBlack text-center mb-1 line-clamp-2 text-sm">
                        {{ $product['product_name'] }}
                    </h3>
                    @if(!empty($product['brands']))
                        <p class="text-gray-400 text-xs text-center mb-3">{{ $product['brands'] }}</p>
                    @endif
                    <a href="{{ route('products.show', $product['code']) }}"
                       class="block w-full text-center bg-gray-600 hover:bg-gray-700 text-white py-2 rounded-lg text-sm font-medium transition-colors">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-center gap-3 mt-8">
            @if($page > 1)
            <a href="{{ route('products.index', array_merge(request()->except('page'), ['page' => $page - 1])) }}"
               class="px-5 py-2 rounded-lg bg-white border border-gray-200 text-jetBlack hover:border-tealMist transition-colors text-sm font-medium">
                Sebelumnya
            </a>
            @endif
            <span class="px-4 py-2 text-jetBlack text-sm font-medium">
                Halaman {{ $page }} dari {{ $totalPages }}
            </span>
            @if($page < $totalPages)
            <a href="{{ route('products.index', array_merge(request()->except('page'), ['page' => $page + 1])) }}"
               class="px-5 py-2 rounded-lg bg-white border border-gray-200 text-jetBlack hover:border-tealMist transition-colors text-sm font-medium">
                Selanjutnya
            </a>
            @endif
        </div>
    @endif
</div>
@endsection
