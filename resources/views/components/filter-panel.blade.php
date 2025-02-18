<div class="bg-white shadow rounded-lg p-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Filter</h3>
    <form action="{{ route('products') }}">
        <div class="mb-6">
            <h4 class="font-medium text-gray-900 mb-3">Warna</h4>
            <div class="space-y-2">
                @foreach ($colors as $color)
                    <label class="flex items-center">
                        <input
                            {{ $selectedColors !== null && in_array($color->name, $selectedColors) ? 'checked' : '' }}
                            type="checkbox" name="colors[]" value="{{ $color->name }}"
                            class="rounded border-gray-300 text-custom focus:ring-custom" />
                        <span class="ml-2 text-gray-700">{{ $color->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>
        <div class="mb-6">
            <h4 class="font-medium text-gray-900 mb-3">Rentang Harga</h4>
            <div class="space-y-2">
                @foreach ([['id' => 1, 'label' => 'Dibawah Rp 50.000', 'value' => 'below_50000'], ['id' => 2, 'label' => 'Rp 50.000 - Rp 100.000', 'value' => '50000_100000'], ['id' => 3, 'label' => 'Rp 100.000 - Rp 500.000', 'value' => '100000_500000'], ['id' => 4, 'label' => 'Rp 500.000 - Rp 1.000.000', 'value' => '500000_1000000'], ['id' => 5, 'label' => 'Diatas Rp 1.000.000', 'value' => 'above_1000000']] as $priceRange)
                    <label class="flex items-center">
                        <input @checked($priceRange['value'] == $selectedPrice) type="radio" name="price_range"
                            value="{{ $priceRange['value'] }}" class="text-custom focus:ring-custom" />
                        <span class="ml-2 text-gray-700">{{ $priceRange['label'] }}</span>
                    </label>
                @endforeach
            </div>
        </div>
        <div class="space-y-3">
            <button type="submit"
                class="w-full text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-3">
                Terapkan Filter
            </button>
            <button type="submit"
                class="btn-reset w-full text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5">
                Reset
            </button>
        </div>
    </form>
</div>
