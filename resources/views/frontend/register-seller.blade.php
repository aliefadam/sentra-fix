@extends('layouts.user')

@section('content')
    <form action="{{ route('store.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <main class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="w-1/2 mx-auto">
                <h1 class="text-center text-3xl text-red-700 poppins-bold mt-5 mb-10">Daftar Menjadi Seller</h1>
                <div class="bg-white p-7 rounded-md shadow-md mb-7">
                    <h1 class="text-center poppins-medium text-lg">Informasi Akun</h1>
                    <div class="mb-5 mt-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                            required />
                    </div>
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                            required />
                    </div>
                    <div class="mb-5">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            No. Telephone
                        </label>
                        <input type="number" id="phone" name="phone" value="{{ old('phone') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                            required />
                    </div>
                    <div class="mb-5">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <div class="relative mb-6">
                            <input type="password" id="password" name="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                            <button type="button"
                                class="show-password absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="">
                        <label for="password_confirmation"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi Password</label>
                        <div class="relative mb-6">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                            <button type="button"
                                class="show-password-confirmation absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-7 rounded-md shadow-md mb-7">
                    <h1 class="text-center poppins-medium text-lg">Informasi Toko</h1>
                    <div class="mb-5 mt-5">
                        <label for="store_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nama Toko
                        </label>
                        <input type="text" id="store_name" name="store_name" value="{{ old('store_name') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                            required />
                    </div>
                    <div class="mb-5">
                        <label for="store_description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Toko</label>
                        <textarea id="store_description" rows="4" name="store_description"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 resize-none">{{ old('store_description') }}</textarea>
                    </div>
                    <div class="mb-2">
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Kategori Toko
                        </label>
                        <div class="grid grid-cols-4 gap-3 mt-4">
                            @foreach ($categories as $index => $category)
                                <div class="flex items-center mb-4">
                                    <input id="category-checkbox-{{ $index }}" type="checkbox"
                                        value="{{ $category->id }}" name="store_category[]"
                                        class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 -translate-y-[2px]">
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
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="store_image" name="store_image" type="file">
                    </div>
                </div>

                <div class="bg-white p-7 rounded-md shadow-md mb-7">
                    <h1 class="text-center poppins-medium text-lg">Alamat Toko</h1>
                    <div class="mb-5 grid grid-cols-2 gap-5 mt-7">
                        <div class="">
                            <label for="province"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                            <select id="province" name="province"
                                class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                                <option selected>-- Pilih Provinsi --</option>
                            </select>
                        </div>
                        <div class="">
                            <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Kabupaten/Kota
                            </label>
                            <select id="city" name="city"
                                class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block p-2.5">
                                <option selected id="option-city-first">
                                    Silahkan pilih provinsi dahulu
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-5 grid grid-cols-2 gap-5">
                        <div class="">
                            <label for="subdistrict" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Kabupaten/Kota
                            </label>
                            <select id="subdistrict" name="subdistrict"
                                class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block p-2.5">
                                <option selected id="option-subdistrict-first">Silahkan pilih kota
                                    dahulu
                                </option>
                            </select>
                        </div>
                        <div class="">
                            <label for="postal_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Kode Pos
                            </label>
                            <input type="number" id="postal_code" name="postal_code"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                required />
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Detail
                            Alamat
                            Toko
                        </label>
                        <textarea id="address" rows="4" name="address"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500 resize-none"
                            placeholder="Jl. Sudirman....."></textarea>
                    </div>
                </div>

                <div class="flex justify-center">
                    <button type="submit"
                        class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full w-1/2 text-center text-sm px-5 py-4 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        Mendaftar
                    </button>
                </div>
            </div>
        </main>
    </form>
@endsection

@section('script')
    <script>
        $('.show-password').click(function() {
            const input = $('#password');
            const icon = $(this).find('i');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('.show-password-confirmation').click(function() {
            const input = $('#password_confirmation');
            const icon = $(this).find('i');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        getProvince();
        $("#province").on("change", getCity);
        $("#city").on("change", getSubdistrict);

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
    </script>
@endsection
