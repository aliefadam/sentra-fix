@foreach (getCarts() as $cart)
    <a href="{{ route('product', ['slug' => $cart->product->slug]) }}"
        class="flex justify-between items-center p-4 hover:bg-gray-50">
        <div class="flex items-center gap-3">
            <img src="/uploads/products/{{ getProduct($cart->product_id, $cart->variant1_id, $cart->variant2_id)->image }}"
                class="w-12 h-12 rounded-md shadow-md object-cover" alt="">
            <div class="flex flex-col">
                <span>{{ Str::limit($cart->product->name, 20, '...') }}</span>
                <span class="text-sm text-gray-700">
                    {{ getVariantLabel($cart->product, $cart->variant1_id, $cart->variant2_id) }}
                    x
                    {{ $cart->qty }}
                </span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <span
                class="poppins-semibold text-gray-700">{{ format_rupiah(getProductPrice($cart->product_id, $cart->variant1_id, $cart->variant2_id) * $cart->qty, true) }}</span>
        </div>
    </a>
@endforeach
