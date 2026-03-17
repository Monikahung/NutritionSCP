@extends('admin.layout')
@section('title', $product['product_name'] ?? 'Detail Produk')

@section('content')
<div class="p-6 lg:p-8">
    <a href="{{ route('products.index')}}"
       class="inline-flex items-center gap-2 text-tealMist hover:text-tealMist/80 mb-6 text-sm font-medium transition-colors">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Produk
    </a>

    @if(isset($error))
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-4 text-sm">{{ $error }}</div>
    @endif

    @php
        $gradeColors = ['a'=>'#6ea89e','b'=>'#a6d2c8','c'=>'#fbbf24','d'=>'#f97316','e'=>'#dc2626'];
        $gradeLabels = ['a'=>'Sangat Sesuai','b'=>'Sesuai','c'=>'Sedang','d'=>'Kurang','e'=>'Buruk'];
        $ng = strtolower($product['nutrition_grades'] ?? 'e');
        $gc = $gradeColors[$ng] ?? '#6b7280';
        $gl = $gradeLabels[$ng] ?? 'Tidak diketahui';
        $n  = $product['nutriments'] ?? [];
        $serving = $product['serving_size'] ?? '200 ml';
        $servingFactor = 2;
    @endphp

    <!-- Product Header -->
    <div class="flex flex-col md:flex-row gap-8 mb-8">
        <!-- Image -->
        <div class="md:w-72 flex-shrink-0">
            <div class="bg-gray-200 rounded-xl overflow-hidden aspect-square">
                @if(!empty($product['image_url']))
                    <img src="{{ $product['image_url'] }}"
                         alt="{{ $product['product_name'] }}"
                         class="w-full h-full object-cover"
                         onerror="this.style.display='none';this.parentElement.innerHTML+='<div class=\'flex items-center justify-center h-full text-gray-400 font-semibold text-xl\'>Gambar Produk</div>'">
                @else
                    <div class="flex items-center justify-center h-full text-gray-400 font-semibold text-xl">Gambar Produk</div>
                @endif
            </div>
        </div>

        <!-- Info -->
        <div class="flex-1">
            <h1 class="text-3xl font-bold text-jetBlack mb-3">{{ $product['product_name'] }}</h1>

            @if(!empty($product['brands']))
                <p class="text-gray-500 mb-2 text-sm">Merek: {{ $product['brands'] }}</p>
            @endif

            @if(!empty($product['ingredients_text']))
            <div class="mb-5">
                <p class="font-semibold text-jetBlack mb-1 text-sm">Bahan:</p>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $product['ingredients_text'] }}</p>
            </div>
            @else
            <div class="mb-5">
                <p class="font-semibold text-jetBlack mb-1 text-sm">Bahan:</p>
                <p class="text-gray-400 text-sm">Informasi bahan tidak tersedia</p>
            </div>
            @endif

            <div class="flex flex-wrap gap-3">
                <div class="px-4 py-2 rounded-lg text-white font-semibold text-sm"
                     style="background-color: {{ $gc }}">
                    Nutri-Score {{ strtoupper($ng) }}
                </div>
                @if(isset($product['nutriscore_score']))
                <div class="px-4 py-2 rounded-lg bg-gray-100 text-jetBlack font-semibold text-sm">
                    {{ abs($product['nutriscore_score']) }}% {{ $gl }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Nutrition Table -->
    <div class="rounded-xl overflow-hidden border-2 border-jetBlack/20">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-600 text-white">
                    <th class="text-left p-4 text-sm font-semibold border-r border-black/10">Informasi<br>nilai gizi</th>
                    <th class="text-left p-4 text-sm font-semibold border-r border-black/10">As sold untuk<br>100 g / 100 ml</th>
                    <th class="text-left p-4 text-sm font-semibold">As sold per serving<br>({{ $serving }}) (packaging)</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @php
                    $rows = [
                        ['label' => 'Energi',      'key100' => $n['energy-kcal_100g'] ?? ($n['energy_100g'] ?? null), 'unit' => 'kcal', 'indent' => false],
                        ['label' => 'Lemak',        'key100' => $n['fat_100g'] ?? null,              'unit' => 'g',    'indent' => false],
                        ['label' => 'Lemak jenuh',  'key100' => $n['saturated-fat_100g'] ?? null,    'unit' => 'g',    'indent' => true],
                        ['label' => 'Karbohidrat',  'key100' => $n['carbohydrates_100g'] ?? null,    'unit' => 'g',    'indent' => false],
                        ['label' => 'Gula',         'key100' => $n['sugars_100g'] ?? null,           'unit' => 'g',    'indent' => true],
                        ['label' => 'Serat Pangan', 'key100' => $n['fiber_100g'] ?? null,            'unit' => 'g',    'indent' => false],
                        ['label' => 'Protein',      'key100' => $n['proteins_100g'] ?? null,         'unit' => 'g',    'indent' => false],
                        ['label' => 'Garam',        'key100' => $n['salt_100g'] ?? null,             'unit' => 'g',    'indent' => false],
                        ['label' => 'Natrium',      'key100' => $n['sodium_100g'] ?? null,           'unit' => 'g',    'indent' => false],
                        ['label' => 'Fruits, vegetables, legumes', 'key100' => $n['fruits-vegetables-nuts_100g'] ?? null, 'unit' => '%', 'indent' => false],
                    ];
                @endphp
                @foreach($rows as $i => $row)
                <tr class="{{ $i % 2 === 0 ? 'bg-gray-600/80' : 'bg-gray-500/70' }} text-white">
                    <td class="p-4 text-sm border-r border-black/10 {{ $row['indent'] ? 'pl-8' : '' }}">
                        {{ $row['label'] }}
                    </td>
                    <td class="p-4 text-sm border-r border-black/10">
                        @if($row['key100'] !== null)
                            @if($row['unit'] === 'kcal')
                                {{ number_format($row['key100'], 0) }} kJ ({{ number_format($row['key100'], 0) }} kcal)
                            @elseif($row['unit'] === '%')
                                {{ number_format($row['key100'], 0) }}%
                            @else
                                {{ rtrim(rtrim(number_format($row['key100'], 5, '.', ''), '0'), '.') }} {{ $row['unit'] }}
                            @endif
                        @else
                            ?
                        @endif
                    </td>
                    <td class="p-4 text-sm">
                        @if($row['key100'] !== null)
                            @if($row['unit'] === 'kcal')
                                ? ({{ number_format($row['key100'] * $servingFactor, 0) }} kcal)
                            @elseif($row['unit'] === '%')
                                ?
                            @else
                                {{ rtrim(rtrim(number_format($row['key100'] * $servingFactor, 5, '.', ''), '0'), '.') }} {{ $row['unit'] }}
                            @endif
                        @else
                            ?
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
