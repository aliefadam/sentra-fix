@extends('layouts.user')

@section('content')
    <form action="{{ route('transaction.store') }}" method="POST" id="transaction-store">
        @csrf
        <input type="hidden" name="subdistrict-input" id="subdistrict-input"
            value="{{ $active_address ? json_decode($active_address->sub_district)->id : 0 }}">
        <input type="hidden" name="products" value="{{ json_encode($products) }}">
        <main class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow p-6 mb-6 mt-5">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold">Alamat Pengiriman</h2>
                            <button type="button" class="text-custom hover:text-custom-dark !rounded-button"
                                data-modal-target="default-modal" data-modal-toggle="default-modal">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </button>
                        </div>
                        <div class="space-y-1">
                            @if ($active_address == null)
                                <span class="text-gray-600">Anda belum memiliki alamat pengiriman, silahkan klik
                                    tombol
                                    edit</span>
                            @else
                                <p class="font-medium text-lg">{{ $active_address->name }}</p>
                                <p class="poppins-medium text-gray-800"> {{ $active_address->recipient }}
                                    ({{ $active_address->phone }})
                                </p>
                                <p>
                                    {{ $active_address->address }}
                                </p>
                                <p class="">Kecamatan
                                    {{ json_decode($active_address->sub_district)->name }}
                                </p>
                                <p class="">{{ json_decode($active_address->city)->name }},
                                    {{ json_decode($active_address->province)->name }}
                                    ({{ $active_address->postal_code }})
                                </p>
                            @endif
                        </div>
                    </div>
                    <h2 class="text-lg font-semibold mb-4 bg-white rounded-md shadow-md p-4 text-center">Produk yang Dibeli
                    </h2>
                    @foreach ($products as $index => $product)
                        <div class="bg-white rounded-lg shadow p-6 mb-6">
                            <div class="flex justify-between">
                                <div class="flex gap-3">
                                    <img src="/uploads/products/{{ $product->image }}" alt="Headcity"
                                        class="w-20 h-20 object-cover rounded shadow-md" />
                                    <div class="">
                                        <h3 class="font-medium">{{ $product->name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $product->variant_label }}</p>
                                        <p class="mt-2">{{ $product->qty }} x
                                            {{ format_rupiah($product->price, true) }}</p>
                                    </div>
                                </div>
                                <div class="self-end">
                                    <p class="font-medium">{{ format_rupiah($product->total, true) }}</p>
                                </div>
                            </div>
                            <div class="mt-5">
                                <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Catatan
                                </label>
                                <textarea id="notes" name="notes[]" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-500 resize-none"
                                    placeholder="Tuliskan catatan untuk pesanan anda"></textarea>
                            </div>
                            <div class="mt-5">
                                <h2 class="text-lg font-semibold mb-4">Pilih Pengiriman</h2>
                                @if ($active_address == null)
                                    <span class="text-gray-600">Silahkan pilih alamat terlebih dahulu</span>
                                @else
                                    <div class="space-y-4" id="container-shipping-{{ $index }}"></div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-semibold mb-4">Metode Pembayaran</h2>
                        <div class="space-y-4">
                            <div class="mb-6">
                                <h3 class="text-md font-medium mb-3">Virtual Account</h3>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 sm:gap-3">
                                    <div
                                        class="flex items-center gap-1 ps-4 py-1 border border-gray-200 rounded-sm dark:border-gray-700">
                                        <input id="method-payment-bca" type="radio" value="VA_BCA" name="method_payment"
                                            class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="method-payment-bca"
                                            class="flex items-center w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            <img src="{{ asset('imgs/bca.png') }}" class="h-4 w-auto mr-3" />
                                            <span class="text-sm">BCA</span>
                                        </label>
                                    </div>
                                    <div
                                        class="flex items-center gap-1 ps-4 py-1 border border-gray-200 rounded-sm dark:border-gray-700">
                                        <input id="method-payment-mandiri" type="radio" value="VA_MANDIRI"
                                            name="method_payment"
                                            class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="method-payment-mandiri"
                                            class="flex items-center w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            <img src="{{ asset('imgs/mandiri.png') }}" class="h-4 w-auto mr-3" />
                                            <span class="text-sm">Mandiri</span>
                                        </label>
                                    </div>
                                    <div
                                        class="flex items-center gap-1 ps-4 py-1 border border-gray-200 rounded-sm dark:border-gray-700">
                                        <input id="method-payment-bri" type="radio" value="VA_BRI" name="method_payment"
                                            class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="method-payment-bri"
                                            class="flex items-center w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            <img src="{{ asset('imgs/bri.png') }}" class="h-4 w-auto mr-3" />
                                            <span class="text-sm">BRI</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-md font-medium mb-3">E-Wallet</h3>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 sm:gap-3">
                                    <div
                                        class="flex items-center gap-1 ps-4 py-1 border border-gray-200 rounded-sm dark:border-gray-700">
                                        <input id="method-payment-qris" type="radio" value="E-WALLET_QRIS"
                                            name="method_payment"
                                            class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="method-payment-qris"
                                            class="flex items-center w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            <img src="{{ asset('imgs/qris.png') }}" class="h-4 w-auto mr-3" />
                                            <span class="text-sm">QRIS</span>
                                        </label>
                                    </div>
                                    <div
                                        class="flex items-center gap-1 ps-4 py-1 border border-gray-200 rounded-sm dark:border-gray-700">
                                        <input id="method-payment-ovo" type="radio" value="E-WALLET_OVO"
                                            name="method_payment"
                                            class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="method-payment-ovo"
                                            class="flex items-center w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            <img src="{{ asset('imgs/ovo.png') }}" class="h-4 w-auto mr-3" />
                                            <span class="text-sm">OVO</span>
                                        </label>
                                    </div>
                                    <div
                                        class="flex items-center gap-1 ps-4 py-1 border border-gray-200 rounded-sm dark:border-gray-700">
                                        <input id="method-payment-dana" type="radio" value="E-WALLET_DANA"
                                            name="method_payment"
                                            class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="method-payment-dana"
                                            class="flex items-center w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            <img src="{{ asset('imgs/dana.png') }}" class="h-4 w-auto mr-3" />
                                            <span class="text-sm">Dana</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow p-4 sm:p-6 sticky top-[90px]">
                        <h2 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h2>
                        @php
                            $subtotal_product = collect($products)->sum('total');
                        @endphp
                        <div class="space-y-3 pb-4 border-b">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal Produk</span>
                                <span>{{ format_rupiah($subtotal_product, true) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Biaya Pengiriman</span>
                                @if ($active_address == null)
                                    <span class="" id="shipping-cost">0</span>
                                @else
                                    <span class="" id="shipping-cost">Menghitung...</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-between py-4">
                            <span class="font-semibold">Total</span>
                            @if ($active_address == null)
                                <span class="font-semibold"
                                    id="total">{{ format_rupiah($product->total, true) }}</span>
                            @else
                                <span class="font-semibold" id="total">Menghitung...</span>
                            @endif
                        </div>
                        <button type="submit"
                            class="text-white bg-pink-700 hover:bg-pink-800 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-3 w-full dark:bg-pink-600 dark:hover:bg-pink-700 focus:outline-none dark:focus:ring-pink-800">
                            Buat Pesanan
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </form>

    {{-- Modal Edit Alamat --}}
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white overflow-hidden rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Ganti Alamat
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="h-[500px] overflow-y-auto scrollbar">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex w-full -mb-px text-sm font-medium text-center" id="default-styled-tab"
                            data-tabs-toggle="#default-styled-tab-content"
                            data-tabs-active-classes="text-pink-600 hover:text-pink-600 dark:text-pink-500 dark:hover:text-pink-500 border-pink-600 dark:border-pink-500"
                            data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                            role="tablist">
                            <li class="w-full" role="presentation">
                                <button class="w-full inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab"
                                    data-tabs-target="#styled-profile" type="button" role="tab"
                                    aria-controls="profile" aria-selected="false">Ganti Alamat</button>
                            </li>
                            <li class="w-full " role="presentation">
                                <button
                                    class="w-full inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                                    id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button"
                                    role="tab" aria-controls="dashboard" aria-selected="false">Tambah Alamat</button>
                            </li>
                        </ul>
                    </div>
                    <div id="default-styled-tab-content">
                        <div class="hidden rounded-lg" id="styled-profile" role="tabpanel"
                            aria-labelledby="profile-tab">
                            @foreach ($addresses as $address)
                                <div class="flex justify-between p-5 border-b">
                                    <div class="space-y-1">
                                        <p class="font-medium">{{ $address->name }}</p>
                                        <p class="poppins-medium text-gray-800"> {{ $address->recipient }}
                                            ({{ $address->phone }})
                                        </p>
                                        <p class="text-sm">
                                            {{ $address->address }}
                                        </p>
                                        <p class="text-sm">Kecamatan
                                            {{ json_decode($address->sub_district)->name }}
                                        </p>
                                        <p class="text-sm">{{ json_decode($address->city)->name }},
                                            {{ json_decode($address->province)->name }}
                                            ({{ $address->postal_code }})
                                        </p>
                                    </div>
                                    <div class="">
                                        @if ($address->is_active)
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">
                                                Alamat Aktif
                                            </span>
                                        @else
                                            <button type="button" data-address-id="{{ $address->id }}"
                                                class="btn-change-address bg-white border border-pink-700 text-pink-700 hover:bg-pink-50 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-xs px-5 py-2.5 dark:bg-pink-600 dark:hover:bg-pink-700 focus:outline-none dark:focus:ring-pink-800">
                                                Gunakan
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="hidden rounded-lg" id="styled-dashboard" role="tabpanel"
                            aria-labelledby="dashboard-tab">
                            <form action="{{ route('address.store') }}" class="p-5" method="POST"
                                id="address-store">
                                @csrf
                                <div class="mb-5">
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                        Alamat</label>
                                    <input type="text" id="name" name="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500"
                                        placeholder="rumah, kantor, dll." required />
                                </div>
                                <div class="mb-5 grid grid-cols-2 gap-5">
                                    <div class="">
                                        <label for="recipient"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                            Penerima</label>
                                        <input type="text" id="recipient" name="recipient"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500"
                                            required />
                                    </div>
                                    <div class="">
                                        <label for="phone"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Telepon
                                            Penerima</label>
                                        <input type="number" id="phone" name="phone"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500"
                                            required />
                                    </div>
                                </div>
                                <div class="mb-5 grid grid-cols-2 gap-5">
                                    <div class="">
                                        <label for="province"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                                        <select id="province" name="province"
                                            class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500">
                                            <option selected>-- Pilih Provinsi --</option>
                                        </select>
                                    </div>
                                    <div class="">
                                        <label for="city"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Kabupaten/Kota
                                        </label>
                                        <select id="city" name="city"
                                            class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block p-2.5">
                                            <option selected id="option-city-first">
                                                Silahkan pilih provinsi dahulu
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-5 grid grid-cols-2 gap-5">
                                    <div class="">
                                        <label for="subdistrict"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Kabupaten/Kota
                                        </label>
                                        <select id="subdistrict" name="subdistrict"
                                            class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block p-2.5">
                                            <option selected id="option-subdistrict-first">Silahkan pilih kota
                                                dahulu
                                            </option>
                                        </select>
                                    </div>
                                    <div class="">
                                        <label for="postal_code"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Kode Pos
                                        </label>
                                        <input type="number" id="postal_code" name="postal_code"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500"
                                            required />
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label for="address"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Detail Alamat
                                        Rumah</label>
                                    <textarea id="address" rows="4" name="address"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-500 resize-none"
                                        placeholder="Jl. Sudirman....."></textarea>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="text-white bg-pink-700 hover:bg-pink-800 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                        Tambah
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // console.log(@json($products));

        const active_address = @json($active_address);

        if (active_address != null) {
            getShippingCost();
        }

        getProvince();

        $("#transaction-store").on("submit", transactionStore);
        $("#address-store").on("submit", addressStore);
        $("#province").on("change", getCity);
        $("#city").on("change", getSubdistrict);
        $(".btn-change-address").click(changeAddress);
        $("input[name^='shipping']").change(getTotal);

        function getProvince() {
            $.ajax({
                type: "GET",
                url: "/rajaongkir/province",
                success: function(response) {
                    const provinces = response;
                    provinces.forEach((province) => {
                        $("#province").append(
                            `<option value="${province.province_id}">${province.province}</option>`
                        );
                    })
                }
            });
        }

        function getCity() {
            const provinceID = $("#province").val();
            $.ajax({
                type: "GET",
                url: "/rajaongkir/city/" + provinceID,
                beforeSend: function() {
                    $("#city").html("<option selected>Loading...</option>");
                },
                success: function(response) {
                    $("#city").html("<option selected>-- Pilih Kabupaten/kota --</option>");
                    const cities = response;
                    cities.forEach((city) => {
                        $("#city").append(
                            `<option value="${city.city_id}">${city.city_name}</option>`
                        );
                    })
                }
            });
        }

        function getSubdistrict() {
            const cityID = $("#city").val();
            $.ajax({
                type: "GET",
                url: "/rajaongkir/subdistrict/" + cityID,
                beforeSend: function() {
                    $("#subdistrict").html("<option selected>Loading...</option>");
                },
                success: function(response) {
                    $("#subdistrict").html("<option selected>-- Pilih Kecamatan --</option>");
                    const subdistricts = response;
                    subdistricts.forEach((subdistrict) => {
                        $("#subdistrict").append(
                            `<option value="${subdistrict.subdistrict_id}">${subdistrict.subdistrict_name}</option>`
                        );
                    })
                }
            });
        }

        function addressStore(e) {
            e.preventDefault();

            const data = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "/address",
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
                    location.reload();
                }
            });
        }

        function changeAddress() {
            const addressID = $(this).data("address-id");
            $.ajax({
                type: "PUT",
                url: `/address/change/${addressID}`,
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
                    location.reload();
                }
            });
        }

        function getShippingCost() {
            const subdistrictID = $("#subdistrict-input").val();

            $.ajax({
                type: "POST",
                url: "/rajaongkir/get-shipping-cost-shipment",
                data: {
                    _token: "{{ csrf_token() }}",
                    data_shipment: @json($products),
                    origin: "444", // store_city_id
                    originType: "city",
                    destination: subdistrictID,
                    destinationType: "subdistrict",
                    weight: "2000",
                    courier: "sicepat",
                },
                beforeSend: function() {
                    const dataCount = @json($products).length;
                    for (let i = 0; i < dataCount; i++) {
                        $(`#container-shipping-${i}`).html(`
                        <div class="flex justify-center items-center py-5">
                            <div role="status">
                                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-pink-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        `);
                    }
                },
                success: function(response) {
                    response.forEach((item, index) => {
                        // const filteredCourier = item.filter(courier => courier.service != "GOKIL");
                        const couriers = item.map((courier) => {
                            return {
                                service: "SICEPAT " + courier.service,
                                price: courier.cost[0].value,
                                etd: courier.cost[0].etd,
                            }
                        });

                        let html = "";
                        couriers.forEach((courier, i) => {
                            html += `
                            <div
                                class="flex items-center gap-2 ps-4 py-1 border border-gray-200 rounded-sm dark:border-gray-700">
                                <input id="shipping-option-${i}-${index}" type="radio" value="${courier.service}_${courier.etd}_${courier.price}" name="shipping-${index}" ${i == 0 ? 'checked' : ''}
                                    class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 focus:ring-pink-500 ">
                                <label for="shipping-option-${i}-${index}"
                                    class="flex flex-col poppins-medium w-full py-4 ms-2 text-gray-900 dark:text-gray-300">
                                    <span class="">${courier.service} <span class="mx-1.5">•</span> Estimasi ${courier.etd}</span>
                                    <span class="text-sm text-gray-600">
                                        ${Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(courier.price)}
                                        </span>
                                </label>
                            </div>
                        `;
                        })
                        $(`#container-shipping-${index}`).html(html);
                    })

                    $("input[name^='shipping']").change(getTotal);
                    getTotal();
                }
            });
        }

        function getTotal() {
            const dataCount = @json($products).length;
            let totalShippingCost = 0;
            let totalSubTotal = 0;

            $("input[name^='shipping']:checked").each(function() {
                const shippingCost = parseInt($(this).val().split("_")[2]);
                totalShippingCost += shippingCost;
            });

            @foreach ($products as $product)
                totalSubTotal += {{ $product->total }};
            @endforeach

            $("#shipping-cost").html(
                `${Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(totalShippingCost)}`
            );

            const total = totalSubTotal + totalShippingCost;
            $("#total").html(
                `${Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(total)}`
            );
        }

        function transactionStore(e) {
            e.preventDefault();
            const method_payment = $("input[name='method_payment']:checked").val();

            if (method_payment == null) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pilih metode pembayaran terlebih dahulu',
                    showConfirmButton: false,
                    timer: 3000,
                });
            } else {
                const data = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "/transaction/shipment",
                    data: data,
                    beforeSend: function() {
                        Swal.fire({
                            title: "Loading",
                            text: "Menyiapkan Pesanan anda...",
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        // console.log(response);

                        if (response.message == "success") {
                            const invoice = response.invoice;
                            window.location.href = `/payment-waiting/${invoice}`;
                        } else {
                            location.reload();
                        }
                    }
                });
            }
        }
    </script>
@endsection
