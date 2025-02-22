@extends('layouts.user')

@section('content')
    <main class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">
                Keranjang Belanja ({{ $carts->count() }} Item)
            </h1>
            <button class="text-custom hover:text-custom-dark btn-delete-all-cart hover:text-red-700">
                <i class="fas fa-trash-alt mr-2"></i>Hapus Semua
            </button>
        </div>
        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-12 md:col-span-8">
                <div class="bg-white rounded-lg shadow-sm divide-y">
                    @foreach ($carts as $cart)
                        <div class="p-6 flex justify-between bg-white rounded-md shadow-md">
                            <div class="">
                                <div class="flex gap-3">
                                    <input type="checkbox" data-product-id="{{ $cart->product_id }}"
                                        data-variant-1-id="{{ $cart->variant1_id }}"
                                        data-variant-2-id="{{ $cart->variant2_id }}"
                                        class="checbox-cart w-5 h-5 rounded border-gray-600 text-pink-700 focus:ring-pink-700" />
                                    <div class="flex gap-4">
                                        <img src="/uploads/products/{{ getProduct($cart->product_id, $cart->variant1_id, $cart->variant2_id)->image }}"
                                            alt="Smartphone Pro Max" class="size-24 object-cover rounded shadow-md" />
                                        <div class="flex flex-col">
                                            <h3 class="text-lg font-medium text-gray-900">
                                                {{ $cart->product->name }}
                                            </h3>
                                            <p class="text-sm text-gray-500">
                                                {{ getVariantLabel($cart->product, $cart->variant1_id, $cart->variant2_id) }}
                                            </p>
                                            <span class="text-lg mt-4 font-medium text-gray-900">
                                                {{ format_rupiah(getProductPrice($cart->product_id, $cart->variant1_id, $cart->variant2_id), true) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col justify-between items-end">
                                <div class="">
                                    <button type="button" data-cart-id="{{ $cart->id }}"
                                        class="btn-delete-cart-item text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5 ">
                                        <i class="fa-regular fa-trash mr-1"></i>
                                        Hapus
                                    </button>
                                </div>
                                <div class="flex items-center">
                                    <div class="ml-auto flex items-center border rounded-lg">
                                        <button class="btn-minus px-3 py-1 text-gray-600 hover:text-custom !rounded-button">
                                            -
                                        </button>
                                        <input type="hidden" name="cart-qty-input" value="{{ $cart->qty }}">
                                        <span class="px-3 py-1 border-x cart-qrty">{{ $cart->qty }}</span>
                                        <button class="btn-plus px-3 py-1 text-gray-600 hover:text-custom !rounded-button">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-span-12 md:col-span-4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        Ringkasan Belanja
                    </h2>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Harga (<span id="total-barang">0</span> Barang)</span>
                            <span class="font-medium" id="total-harga">Rp 0</span>
                        </div>

                        <div class="pt-4 border-t">
                            <div class="flex justify-between">
                                <span class="font-medium">Total Tagihan</span>
                                <span class="text-lg font-bold text-custom" id="total-tagihan">Rp 0</span>
                            </div>
                        </div>

                        <button type="button" id="btn-shipment"
                            class="text-white bg-pink-700 hover:bg-pink-800 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-3 mt-5 w-full">
                            Lanjut ke Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        $(".btn-minus").click(function() {
            changeQuantity($(this), "minus");
        });
        $(".btn-plus").click(function() {
            changeQuantity($(this), "plus");
        });

        $(".checbox-cart").change(getTotal);
        $(".btn-delete-cart-item").click(deleteCart);
        $(".btn-delete-all-cart").click(deleteAllCart);
        $("#btn-shipment").click(shipment);

        function changeQuantity(self, type) {
            const input = self.parent().find("input[name='cart-qty-input']");
            const inputLabel = self.parent().find(".qty-cart");
            let value = parseInt(input.val());
            if (type == "minus") {
                if (value > 1) {
                    value--;
                }
            } else {
                value++;
            }
            input.val(value);
            self.parent().find("span.cart-qrty").text(value);
            getTotal();
        }

        function getTotal() {
            const data = $(".checbox-cart:checked").map((i, item) => {
                return {
                    product_id: $(item).data("product-id"),
                    variant1_id: $(item).data("variant-1-id"),
                    variant2_id: $(item).data("variant-2-id") == "" ? null : $(item).data("variant-2-id"),
                    qty: $(item).parent().parent().parent().find(`input[name=cart-qty-input]`).val(),
                };
            }).toArray();

            if (data.length != 0) {
                $.ajax({
                    type: "POST",
                    url: "/cart/total",
                    data: {
                        _token: "{{ csrf_token() }}",
                        data,
                    },
                    beforeSend: function() {
                        $("#total-barang").text("...");
                        $("#total-harga").text("...");
                        $("#total-tagihan").text("...");
                    },
                    success: function(response) {
                        const {
                            total_harga,
                            jumlah_barang
                        } = response;

                        $("#total-barang").text(jumlah_barang);
                        $("#total-harga").text(total_harga);
                        $("#total-tagihan").text(total_harga);
                    }
                });
            } else {
                $("#total-barang").text(0);
                $("#total-harga").text("Rp 0");
                $("#total-tagihan").text("Rp 0");
            }
        }

        function deleteCart() {
            const cartID = $(this).data("cart-id");
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda akan menghapus item ini dari keranjang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: `/cart/${cartID}`,
                        data: {
                            _token: "{{ csrf_token() }}",
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
                            Swal.close();
                            location.reload();
                        }
                    });
                }
            });
        }

        function deleteAllCart() {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda akan seluruh item dari keranjang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: `/cart/delete/all`,
                        data: {
                            _token: "{{ csrf_token() }}",
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
                            Swal.close();
                            location.reload();
                        }
                    });
                }
            });
        }

        function shipment() {
            const data = $(".checbox-cart:checked").map((i, item) => {
                return {
                    product_id: $(item).data("product-id"),
                    variant1_id: $(item).data("variant-1-id"),
                    variant2_id: $(item).data("variant-2-id") == "" ? null : $(item).data("variant-2-id"),
                    qty: $(item).parent().parent().parent().find(`input[name=cart-qty-input]`).val(),
                };
            }).toArray();

            if (data.length != 0) {
                $.ajax({
                    type: "POST",
                    url: "/cart/shipment",
                    data: {
                        _token: "{{ csrf_token() }}",
                        data,
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
                        const redirect_url = response.redirect_url;
                        window.location.href = redirect_url;
                    }
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Silahkan pilih setidaknya 1 barang",
                    confirmButtonColor: '#3085d6',
                });
            }
        }
    </script>
@endsection
