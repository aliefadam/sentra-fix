@extends('layouts.user')

@section('content')
    <form id="form-checkout" action="{{ route('product.checkout', ['slug' => $product->slug]) }}" method="POST">
        @csrf
        <main class="max-w-8xl mx-auto px-4 sm:px-4 lg:px-8 py-4 sm:py-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 md:gap-8">
                <div class="space-y-4 lg:col-span-5">
                    <div class="w-full h-[300px] lg:h-[500px] bg-gray-100 rounded-lg overflow-hidden shadow-md">
                        <img src="/uploads/products/{{ $product->productDetails[0]->image }}"
                            class="w-full h-full object-center object-cover" id="product-image-thumbnail" />
                    </div>
                    <div class="grid grid-cols-4 gap-2 sm:gap-4">
                        @foreach ($product->productDetails as $index => $detail)
                            <button type="button" data-image="/uploads/products/{{ $detail->image }}"
                                class="btn-change-image aspect-w-1 aspect-h-1 bg-gray-100 {{ $index == 0 ? 'border-2 border-red-700' : '' }} rounded-lg overflow-hidden shadow-md">
                                <img src="/uploads/products/{{ $detail->image }}"
                                    class="w-full h-full object-center object-cover" />
                            </button>
                        @endforeach
                    </div>
                </div>
                <div class="space-y-6 lg:col-span-7">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                            {{ $product->name }}
                        </h1>
                        <div class="mt-2 flex items-center">
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star text-yellow-400"></i>
                                <i class="fas fa-star-half-alt text-yellow-400"></i>
                            </div>
                            {{-- <span class="ml-2 text-sm text-gray-500">(95 ulasan)</span> --}}
                        </div>
                        {{-- <a href="" class="text-red-600 hover:text-red-700 block poppins-medium mt-4 mb-2">
                            <i class="fa-regular fa-store"></i> {{ $product->user->store->name }}
                        </a> --}}
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-bold text-custom" id="product-price">
                            {{ format_rupiah(getProductPrice($product->id, $product->productDetails[0]->variant1_id, $product->productDetails[0]->variant2_id), true) }}
                        </p>
                        <p class="mt-2 text-gray-900" id="product-stock">Sisa stok
                            {{ getProductStock($product->id, $product->productDetails[0]->variant1_id, $product->productDetails[0]->variant2_id) }}
                        </p>
                    </div>
                    <div class="border-t border-b border-gray-200 py-6">
                        <div class="space-y-4">
                            @php
                                $numberVariant = 1;
                            @endphp
                            @foreach ($variants as $key => $variant)
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $key }}</h3>
                                    <div class="mt-2 grid grid-cols-2 lg:grid-cols-4 gap-3">
                                        @foreach ($variant as $index => $v)
                                            <div class="flex items-center ps-4 border border-gray-200 rounded-sm">
                                                <input @checked($index == 0) id="{{ $v['id'] }}" type="radio"
                                                    data-image="/uploads/products/{{ $detail->image }}"
                                                    value="{{ $v['id'] }}" name="variant{{ $numberVariant }}_id"
                                                    class="change-variant w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 ">
                                                <label for="{{ $v['id'] }}"
                                                    class="w-full py-4 ms-2 text-sm font-medium text-gray-900">{{ $v['label'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @php
                                    $numberVariant++;
                                @endphp
                            @endforeach
                            <div>
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-medium text-gray-900">Jumlah</h3>
                                    <div class="flex items-center space-x-5">
                                        <button type="button"
                                            class="btn-minus-quantity w-8 h-8 flex items-center justify-center border border-gray-300 !rounded-button">
                                            <i class="fas fa-minus text-sm"></i>
                                        </button>
                                        <input type="hidden" name="qty" id="product-quantity-input" value="1">
                                        <span id="product-quantity" class="text-lg font-medium">1</span>
                                        <button type="button"
                                            class="btn-add-quantity w-8 h-8 flex items-center justify-center border border-gray-300 !rounded-button">
                                            <i class="fas fa-plus text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <button type="submit" id="btn-checkout"
                            class="block text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-3 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Beli
                            Sekarang</button>
                        {{-- <button type="submit"
                            class="block text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-3 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Beli
                            Sekarang</button> --}}
                        <button type="button" id="btn-add-to-cart" data-product-id="{{ $product->id }}"
                            class="text-red-700 bg-white border border-red-700 hover:bg-red-100 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-3 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Masukkan
                            Keranjang</button>
                    </div>
                    <div class="border-t pt-4 flex justify-between">
                        <div class="flex items-center gap-4">
                            <img class="size-12 object-cover rounded-full shadow-md"
                                src="/uploads/stores/{{ $product->user->store->image }}" alt="">
                            <div class="flex flex-col">
                                <span class="text-gray-900 poppins-medium">
                                    <i class="fa-regular fa-store"></i> {{ $product->user->store->name }}
                                </span>
                                <span class="text-sm text-gray-800">
                                    {{ json_decode($product->user->addresses()->first()->city)->name }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('store.show', $product->user->store->slug) }}"
                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-5 py-2.5 h-fit text-center dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            Kunjungi Toko
                        </a>
                    </div>
                    <div class="prose prose-sm max-w-none">
                        <h3 class="text-lg font-medium">Deskripsi Produk</h3>
                        <div class="ckeditor">{!! $product->description !!}</div>
                    </div>
                </div>
            </div>
        </main>
    </form>
@endsection

@section('script')
    <script>
        $(".btn-change-image").click(changeImage);
        $(".change-variant").change(changeVariant);
        $(".btn-add-quantity").click(function() {
            changeQuantity("add");
        });
        $(".btn-minus-quantity").click(function() {
            changeQuantity("minus");
        });
        $("#btn-add-to-cart").click(addCart);
        $("#form-checkout").submit(checkout);

        function changeImage() {
            const image = $(this).data("image");
            $("#product-image-thumbnail").attr("src", image);
            $(this).addClass("border-2 border-red-700")
                .siblings()
                .removeClass("border-2 border-red-700");
            // $(".change-variant[data-image='" + image + "']").prop("checked", true);
        }

        function changeVariant() {
            // const image = $(this).data("image");

            // $("#product-image-thumbnail").attr("src", image);
            // $(".btn-change-image").removeClass("border-2 border-red-700");
            // $(".btn-change-image[data-image='" + image + "']").addClass("border-2 border-red-700");

            getStock();
        }

        function changeQuantity(type) {
            const quantity = $("#product-quantity").text();
            if (type == "add") {
                $("#product-quantity").text(parseInt(quantity) + 1);
                $("#product-quantity-input").val(parseInt(quantity) + 1);
            } else {
                if (parseInt(quantity) == 1) return;
                $("#product-quantity").text(parseInt(quantity) - 1);
                $("#product-quantity-input").val(parseInt(quantity) - 1);
            }
        }

        function getStock() {
            const productID = {{ $product->id }};
            const variant1ID = $("input[name='variant1_id']:checked").val();
            const variant2ID = $("input[name='variant2_id']:checked").val() ?? null;

            $.ajax({
                type: "GET",
                url: `/get-stock/${productID}/${variant1ID}/${variant2ID}`,
                beforeSend: function() {
                    $("#product-price").html("Loading...");
                    $("#product-stock").html("Loading...");
                },
                success: function(response) {
                    const price = response.price;
                    const stock = response.stock;
                    const image = response.image;
                    $("#product-price").text(price);
                    $("#product-stock").text("Sisa stok " + stock);
                    $("#product-image-thumbnail").attr("src", `/uploads/products/${image}`);
                    $(".btn-change-image").removeClass("border-2 border-red-700");
                    $(`.btn-change-image[data-image="/uploads/products/${image}"]`).addClass(
                        "border-2 border-red-700");
                }
            });

        }

        function addCart() {
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
            const variant1ID = $("input[name='variant1_id']:checked").val();
            const variant2ID = $("input[name='variant2_id']:checked").val() ?? null;
            const qty = +$("#product-quantity-input").val();

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

        function checkout(e) {
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

            const data = $(this).serialize();
            const slug = "{{ $product->slug }}";

            $.ajax({
                type: "POST",
                url: `/product/${slug}/checkout`,
                data: data,
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
                    window.location = response.redirect_url;
                }
            });
        }
    </script>
@endsection
