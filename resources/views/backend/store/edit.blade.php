@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
    </div>

    <form action="{{ route('seller.store.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mt-5">
            <div class="grid grid-cols-2 gap-5">
                <div class="bg-white p-7 rounded-md shadow-md mb-7 h-fit">
                    <h1 class="text-center poppins-medium text-lg">Informasi Toko</h1>
                    <div class="mb-5 mt-5">
                        <label for="store_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nama Toko
                        </label>
                        <input type="text" id="store_name" name="store_name" value="{{ $store->name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500"
                            required />
                    </div>
                    <div class="mb-5">
                        <label for="store_description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Toko</label>
                        <textarea id="store_description" rows="4" name="store_description"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500 resize-none">{{ $store->description }}</textarea>
                    </div>
                    <div class="mb-2">
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Kategori Toko
                        </label>
                        <div class="grid grid-cols-4 gap-3 mt-4">
                            @php
                                $selectedCategories = json_decode($store->category ?? '[]', true);
                            @endphp
                            @foreach ($categories as $index => $category)
                                <div class="flex items-center mb-4">
                                    <input id="category-checkbox-{{ $index }}" type="checkbox"
                                        value="{{ $category->id }}" name="store_category[]"
                                        class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 -translate-y-[2px]"
                                        {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                                    <label for="category-checkbox-{{ $index }}"
                                        class="ms-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="store_image">
                            Foto Toko
                        </label>
                        <div class="flex items-center gap-3">
                            <img class="size-16 object-cover rounded-md shadow-md"
                                src="{{ asset('uploads/stores/' . $store->image) }}" alt="">
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="store_image" name="store_image" type="file">
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="bg-white p-7 rounded-md shadow-md mb-7 h-fit">
                        <h1 class="text-center poppins-medium text-lg">Alamat Toko</h1>
                        @php
                            $address = $store->user->address()->where('is_active', true)->first();
                            $province_id = json_decode($address->province)->id;
                            $city_id = json_decode($address->city)->id;
                            $subdistrict_id = json_decode($address->sub_district)->id;
                            $postal_code = $address->postal_code;
                            $address_detail = $address->address;
                        @endphp
                        <div class="mb-5 grid grid-cols-2 gap-5 mt-7">
                            <div class="">
                                <label for="province"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                                <select id="province" name="province"
                                    class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500">
                                    <option selected>-- Pilih Provinsi --</option>
                                </select>
                            </div>
                            <div class="">
                                <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
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
                                <input type="number" id="postal_code" name="postal_code" value="{{ $postal_code }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500"
                                    required />
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="address"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Detail
                                Alamat
                                Toko
                            </label>
                            <textarea id="address" rows="4" name="address"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-500 resize-none"
                                placeholder="Jl. Sudirman.....">{{ $address_detail }}</textarea>
                        </div>
                    </div>
                    <div class="mt-5 flex justify-end">
                        <button type="submit" id="btn-simpan-perubahan"
                            class="text-white bg-gray-500 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5 cursor-not-allowed"
                            disabled>
                            Loading...
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        getProvince();
        $("#province").on("change", getCity);
        $("#city").on("change", getSubdistrict);

        function getProvince() {
            $.ajax({
                type: "GET",
                url: "/rajaongkir/province",
                success: function(response) {
                    const provinces = response;
                    const provinceIDSelected = {{ $province_id }};

                    provinces.forEach((province) => {
                        $("#province").append(
                            `<option ${province.province_id == provinceIDSelected ? 'selected' : ''} value="${province.province_id}">${province.province}</option>`
                        );
                    })

                    getCity();
                }
            });
        }

        function getCity() {
            const provinceID = $("#province").val();
            const cityIDSelected = {{ $city_id }};

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
                            `<option ${city.city_id == cityIDSelected ? 'selected' : ''} value="${city.city_id}">${city.city_name}</option>`
                        );
                    })

                    getSubdistrict();
                }
            });
        }

        function getSubdistrict() {
            const cityID = $("#city").val();
            const subdistrictIDSelected = {{ $subdistrict_id }};

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
                            `<option ${subdistrict.subdistrict_id == subdistrictIDSelected ? 'selected' : ''} value="${subdistrict.subdistrict_id}">${subdistrict.subdistrict_name}</option>`
                        );
                    })

                    $("#btn-simpan-perubahan").removeClass("cursor-not-allowed").addClass(
                        "bg-pink-700 hover:bg-pink-800").html("Simpan Perubahan").attr("disabled", false);
                }
            });
        }
    </script>
@endsection
