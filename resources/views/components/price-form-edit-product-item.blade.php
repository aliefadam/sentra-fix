@php
    $newVariant = getProduct($product->id, $v1['id'], count($v2) > 0 ? $v2['id'] : null);
@endphp

<div class="grid grid-cols-5 gap-5">
    <input type="hidden" name="variant_id_1{{ $newVariant == '' ? '_new' : '' }}[]" value="{{ $v1['id'] }}">
    <input type="hidden" name="variant_id_2{{ $newVariant == '' ? '_new' : '' }}[]" value="{{ $v2 ? $v2['id'] : '' }}">
    <div class="mb-5">
        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Varian 1
        </label>
        <input type="text" id="text" name="price_variant_1{{ $newVariant == '' ? '_new' : '' }}[]"
            value="{{ $v1['label'] }}" readonly
            class="bg-gray-200 curson-not-allowed border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500"
            required />
    </div>
    <div class="mb-5">
        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Variant 2
        </label>
        <input type="text" id="text" name="price_variant_2{{ $newVariant == '' ? '_new' : '' }}[]"
            value="{{ count($v2) > 0 ? $v2['label'] : '-' }}" readonly
            class="bg-gray-200 curson-not-allowed border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500"
            required />
    </div>
    <div class="mb-5">
        <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
        <input type="number" id="number" name="price{{ $newVariant == '' ? '_new' : '' }}[]"
            value="{{ getProductPrice($product->id, $v1['id'], count($v2) > 0 ? $v2['id'] : null) }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500"
            required />
    </div>
    <div class="mb-5">
        <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
        <input type="number" id="number" name="price_stock{{ $newVariant == '' ? '_new' : '' }}[]"
            value="{{ getProductStock($product->id, $v1['id'], count($v2) > 0 ? $v2['id'] : null) }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500"
            required />
    </div>
    <div class="mb-5">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Gambar</label>
        <div class="flex items-center gap-3">
            @if (getProductImage($product->id, $v1['id'], count($v2) > 0 ? $v2['id'] : null) != '')
                <img class="size-10 object-cover rounded-md shadow-md"
                    src="/uploads/products/{{ getProductImage($product->id, $v1['id'], count($v2) > 0 ? $v2['id'] : null) }}"
                    alt="">
            @endif
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="file_input" type="file" name="price_img{{ $newVariant == '' ? '_new' : '' }}[]"
                @required($newVariant == '')>
        </div>
    </div>
</div>
