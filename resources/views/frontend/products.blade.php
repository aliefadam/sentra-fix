@extends('layouts.user')
@section('content')
    <main class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="w-full md:w-64 flex-shrink-0">
                @include('components.filter-panel')
            </div>
            <div class="flex-1">
                <div class="mb-6 flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-900">Semua Produk</h2>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <a href="{{ route('product', ['slug' => $product->slug]) }}"
                            class="bg-white rounded-lg shadow hover:scale-[101%] duration-100 overflow-hidden">
                            <img src="/uploads/products/{{ $product->productDetails()->first()->image }}"
                                class="w-full h-48 object-cover object-center" alt="Wireless Headphone" />
                            <div class="p-4">
                                <div class="flex items-center mt-1">
                                    <div class="flex text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <h3 class="text-red-600 poppins-medium text-sm mt-3 mb-2">
                                    <i class="fa-regular fa-store"></i> {{ $product->user->store->name }}
                                </h3>
                                <h3 class="font-medium text-lg">{{ $product->name }}</h3>
                                <p class="text-custom font-semibold text-gray-600">{{ getLowerPriceProduct($product->id) }}
                                </p>
                                <button type="button" data-product-id="{{ $product->id }}"
                                    data-variant-1-id="{{ $product->productDetails()->first()->variant1_id }}"
                                    data-variant-2-id="{{ $product->productDetails()->first()->variant2_id }}"
                                    class="btn-add-cart mt-4 w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                    <i class="btn-add-cart fa fa-cart-plus mr-1" data-product-id="{{ $product->id }}"></i>
                                    <span>Keranjang</span>
                                </button>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        $(".btn-reset").click(resetFilter);
        $(".btn-add-cart").click(addCart);

        function resetFilter(e) {
            e.preventDefault();
            location.href = "/products";
        }

        function addCart(e) {
            e.stopPropagation();
            e.preventDefault();

            const isLogin = @json(Auth::check());
            if (!isLogin) {
                Swal.fire({
                    icon: "warning",
                    title: "Perhatian",
                    text: "Anda belum login, silahkan login terlebih dahulu",
                    confirmButton: "Iya",
                    cancelButton: "Batal",
                    confirmButtonText: "Login",
                    confirmButtonColor: "#6366F1",
                    showCancelButton: true,
                    cancelButtonColor: "#EF4444",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = "/login";
                    }
                });
                return;
            }

            const productID = $(this).data("product-id");
            const variant1ID = $(this).data("variant-1-id");
            const variant2ID = $(this).data("variant-2-id");
            const qty = 1;

            $.ajax({
                type: "POST",
                url: "/cart",
                data: {
                    _token: "{{ csrf_token() }}",
                    productID: productID,
                    variant1ID: variant1ID,
                    variant2ID: variant2ID,
                    qty: qty,
                },
                beforeSend: function() {
                    Swal.fire({
                        title: "Loading...",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    const {
                        status,
                        message,
                        cart_count,
                        html_list_cart,
                    } = response;
                    $("#cart-count").text(cart_count);
                    $("#container-cart").html(html_list_cart);

                    Swal.close();
                    Swal.fire({
                        position: 'top-end',
                        icon: message.icon,
                        title: message.title,
                        text: message.text,
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            });
        }
    </script>
@endsection
