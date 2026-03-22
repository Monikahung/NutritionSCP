@extends('public.layout')

@section('content')
<div class="grid grid-cols-2 gap-8 p-6">

    {{-- LEFT SIDE --}}
    <div>
        <h2 class="text-3xl font-bold mb-2">Kalkulator Nutrisi</h2>
        <p class="text-gray-500 mb-4">
            Pilih beberapa produk kemasan untuk mengetahui estimasi kandungan gizi.
        </p>

        @if(!isset($results))
            {{-- MODE INPUT --}}
            <form method="POST" action="{{ route('calculate') }}">
                @csrf

                {{-- SEARCH BAR --}}
                <div class="flex gap-2 items-center mb-2">
                    <input type="text" id="search-input"
                        onkeyup="searchProduct(this)"
                        placeholder="Cari Produk Kemasan"
                        class="border p-2 w-full rounded">

                    <button type="button" onclick="addFromSearch()"
                        class="bg-gray-300 px-3 rounded">+</button>
                </div>

                {{-- SUGGESTION LIST --}}
                <div id="suggestions"
                    class="bg-white border rounded shadow mb-4"></div>

                {{-- LIST PRODUK --}}
                <div id="product-list" class="space-y-3">
                    @if(isset($products))
                        @foreach($products as $code)
                            <div class="flex gap-2 items-center">
                                <input type="text" name="products[]"
                                    value="{{ $code }}"
                                    class="border p-2 w-full rounded bg-gray-100"
                                    readonly>

                                <button type="button"
                                    onclick="removeProduct(this)"
                                    class="bg-gray-300 px-3 rounded">-</button>
                            </div>
                        @endforeach
                    @endif
                </div>

                {{-- ACTION --}}
                <div class="flex gap-4 mt-6">
                    <button type="button" onclick="resetProducts()"
                        class="bg-gray-300 px-4 py-2 rounded">
                        Reset
                    </button>

                    <button type="submit"
                        class="bg-black text-white px-4 py-2 rounded">
                        Hitung
                    </button>
                </div>
            </form>

        @else
            {{-- MODE HASIL (LOCKED) --}}
            <div class="space-y-3">
                @foreach($products as $i => $code)
                    <input type="text"
                        value="{{ $product_names[$i] ?? $code }}"
                        class="border p-2 w-full rounded bg-gray-100"
                        disabled>
                @endforeach
            </div>

            <div class="mt-6">
                <button onclick="window.location='/calculator'"
                    class="bg-gray-300 px-4 py-2 rounded">
                    Reset
                </button>
            </div>
        @endif
    </div>

    {{-- RIGHT SIDE --}}
    <div>
    @if(isset($results) && count($results) > 0)

        @php
            // DETEKSI MINUMAN MAKANAN
            $hasDrink = false;
            $hasFood = false;

            foreach ($results as $item) {
                $categories = strtolower(implode(',', $item['categories'] ?? []));

                if (str_contains($categories, 'drink') || str_contains($categories, 'beverage')) {
                    $hasDrink = true;
                } else {
                    $hasFood = true;
                }
            }
            if ($hasDrink && $hasFood) {
                $unit = 'g'; // campuran → fallback ke gram
            } elseif ($hasDrink) {
                $unit = 'ml';
            } else {
                $unit = 'g';
            }

            // AMBIL SERVING DARI API
            function getServingSize($text) {
                if (!$text) return 100;
                preg_match('/\d+/', $text, $match);
                return isset($match[0]) ? (int)$match[0] : 100;
            }

            $serving = isset($results[0]) ? getServingSize($results[0]['serving_size']) : 100;

            // INIT TOTAL (NULL biar gak jadi 0 palsu)
            $total = [
                'energy' => null,
                'fat' => null,
                'saturated-fat' => null,
                'carbohydrates' => null,
                'sugars' => null,
                'fiber' => null,
                'proteins' => null,
                'salt' => null,
                'sodium' => null,
                'fruits' => null
            ];

            // HITUNG TOTAL
            foreach ($results as $item) {
                $n = $item['nutrition'] ?? [];

                foreach ($total as $key => $val) {
                    if (isset($n[$key])) {
                        $total[$key] = ($total[$key] ?? 0) + $n[$key];
                    }
                }
            }

            // FORMAT FUNCTION
            function formatVal($val, $unit = '') {
                return $val !== null ? number_format($val, 2) . " $unit" : '?';
            }

            function formatServing($val, $serving) {
                return $val !== null ? number_format(($val/100)*$serving, 2) : '?';
            }
        @endphp

        <table class="w-full border border-gray-400 text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Informasi nilai gizi</th>
                    <th>Per 100{{ $unit }}</th>
                    <th>Per serving ({{ $serving }}{{ $unit }})</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td class="p-2 border">Energi</td>
                    <td class="p-2 border">{{ formatVal($total['energy'], 'kcal') }}</td>
                    <td class="p-2 border">
                        {{ $total['energy'] !== null ? formatServing($total['energy'], $serving) . ' kcal' : '?' }}
                    </td>
                </tr>

                <tr>
                    <td class="p-2 border">Lemak</td>
                    <td class="p-2 border">{{ formatVal($total['fat'], 'g') }}</td>
                    <td class="p-2 border">
                        {{ $total['fat'] !== null ? formatServing($total['fat'], $serving) . ' g' : '?' }}
                    </td>
                </tr>

                <tr>
                    <td class="p-2 border">Lemak jenuh</td>
                    <td class="p-2 border">{{ formatVal($total['saturated-fat'], 'g') }}</td>
                    <td class="p-2 border">
                        {{ $total['saturated-fat'] !== null ? formatServing($total['saturated-fat'], $serving) . ' g' : '?' }}
                    </td>
                </tr>

                <tr>
                    <td class="p-2 border">Karbohidrat</td>
                    <td class="p-2 border">{{ formatVal($total['carbohydrates'], 'g') }}</td>
                    <td class="p-2 border">
                        {{ $total['carbohydrates'] !== null ? formatServing($total['carbohydrates'], $serving) . ' g' : '?' }}
                    </td>
                </tr>

                <tr>
                    <td class="p-2 border">Gula</td>
                    <td class="p-2 border">{{ formatVal($total['sugars'], 'g') }}</td>
                    <td class="p-2 border">
                        {{ $total['sugars'] !== null ? formatServing($total['sugars'], $serving) . ' g' : '?' }}
                    </td>
                </tr>

                <tr>
                    <td class="p-2 border">Serat</td>
                    <td class="p-2 border">{{ formatVal($total['fiber'], 'g') }}</td>
                    <td class="p-2 border">
                        {{ $total['fiber'] !== null ? formatServing($total['fiber'], $serving) . ' g' : '?' }}
                    </td>
                </tr>

                <tr>
                    <td class="p-2 border">Protein</td>
                    <td class="p-2 border">{{ formatVal($total['proteins'], 'g') }}</td>
                    <td class="p-2 border">
                        {{ $total['proteins'] !== null ? formatServing($total['proteins'], $serving) . ' g' : '?' }}
                    </td>
                </tr>

                <tr>
                    <td class="p-2 border">Garam</td>
                    <td class="p-2 border">{{ formatVal($total['salt'], 'g') }}</td>
                    <td class="p-2 border">
                        {{ $total['salt'] !== null ? formatServing($total['salt'], $serving) . ' g' : '?' }}
                    </td>
                </tr>

                <tr>
                    <td class="p-2 border">Natrium</td>
                    <td class="p-2 border">{{ formatVal($total['sodium'], 'g') }}</td>
                    <td class="p-2 border">
                        {{ $total['sodium'] !== null ? formatServing($total['sodium'], $serving) . ' g' : '?' }}
                    </td>
                </tr>

            </tbody>
        </table>

    @else
        <div class="bg-gray-200 h-[300px] flex items-center justify-center text-gray-500">
            Ilustrasi Kalkulator
        </div>
    @endif
    </div>

</div>

{{-- SCRIPT --}}
<script>

let selectedProduct = null;

async function searchProduct(input) {
    let query = input.value;

    if (query.length < 3) return;

    let res = await fetch(`/search-products?q=${query}`);
    let data = await res.json();

    let list = document.getElementById('suggestions');
    list.innerHTML = '';

    data.forEach(p => {
        let item = document.createElement('div');
        item.className = "p-2 hover:bg-gray-100 cursor-pointer";
        item.innerText = p.product_name;

        item.onclick = () => {
            input.value = p.product_name;
            selectedProduct = p; // simpan full data
            list.innerHTML = '';
        };

        list.appendChild(item);
    });
}

function addFromSearch() {
    if (!selectedProduct) return;

    let container = document.getElementById('product-list');

    let div = document.createElement('div');
    div.className = "flex gap-2 items-center";

    div.innerHTML = `
        <input type="hidden" name="products[]" value="${selectedProduct.code}">

        <input type="text" value="${selectedProduct.product_name}"
            class="border p-2 w-full rounded bg-gray-100" readonly>

        <input type="hidden" name="product_names[]" value="${selectedProduct.product_name}">

        <button type="button" onclick="removeProduct(this)"
            class="bg-gray-300 px-3 rounded">-</button>
    `;

    container.appendChild(div);

    document.getElementById('search-input').value = '';
    selectedProduct = null;
}
function addProduct() {
    let container = document.getElementById('product-list');

    let div = document.createElement('div');
    div.className = "flex gap-2 items-center";

    div.innerHTML = `
        <input type="text" name="products[]" placeholder="Kode Produk"
            class="border p-2 w-full rounded">
        <button type="button" onclick="removeProduct(this)"
            class="bg-gray-300 px-3 rounded">-</button>
    `;

    container.appendChild(div);
}

function removeProduct(btn) {
    btn.parentElement.remove();
}

function resetProducts() {
    document.getElementById('product-list').innerHTML = '';
}

</script>
@endsection