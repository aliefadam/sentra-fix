@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'before' => [
                'name' => 'Daftar Produk',
                'url' => route('admin.product.index'),
            ],
            'current' => $title,
        ])
    </div>

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mt-5 w-full">
            <div class=" bg-white shadow-md rounded-md p-5 mb-5">
                <h1 class="text-xl poppins-medium mb-5">Data Produk</h1>
                <div class="grid grid-cols-2 gap-5">
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Produk</label>
                        <input type="text" id="name" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                            required />
                    </div>
                    <div class="mb-5">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Kategori
                        </label>
                        <select id="category" name="category"
                            class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                            <option selected>-- Pilih Kategori --</option>
                            @foreach ($sub_categories as $sub_category)
                                <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="ckeditor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Deskripsi Produk
                    </label>
                    <textarea id="ckeditor" rows="4" name="description"
                        class="resize-none block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        placeholder="Tulis deskripsi produk..."></textarea>

                </div>
            </div>
            <div class=" bg-white shadow-md rounded-md p-5 mb-5">
                <h1 class="text-xl poppins-medium mb-5">Varian Produk</h1>
                <div class="grid grid-cols-2 gap-8 mb-5">
                    <div class="">
                        <label for="variant-1" class="block mb-3 text-sm font-medium text-gray-900 dark:text-white">
                            Jenis Varian 1
                        </label>
                        <select id="variant-1" name="variant[]"
                            class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                            <option selected value="">-- Pilih Jenis Varian --</option>
                            @foreach ($variants as $variant)
                                <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <label for="variant_detail" class="block mb-3 text-sm font-medium text-gray-900 dark:text-white">
                            Detail Varian 1
                        </label>
                        <div class="text-gray-600 text-sm" id="hint-text-variant-detail-1">Silahkan pilih jenis variant
                            terlebih
                            dahulu</div>
                        <div class="grid grid-cols-3" id="container-variant-detail-1"></div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8 mb-5">
                    <div class="">
                        <label for="variant-2" class="block mb-3 text-sm font-medium text-gray-900 dark:text-white">
                            Jenis Varian 2
                        </label>
                        <select id="variant-2" name="variant[]"
                            class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                            <option selected value="">-- Pilih Jenis Varian --</option>
                            @foreach ($variants as $variant)
                                <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <label for="variant_detail" class="block mb-3 text-sm font-medium text-gray-900 dark:text-white">
                            Detail Varian 2
                        </label>
                        <div class="text-gray-600 text-sm" id="hint-text-variant-detail-2">Silahkan pilih jenis variant
                            terlebih
                            dahulu</div>
                        <div class="grid grid-cols-3" id="container-variant-detail-2"></div>
                    </div>
                </div>
                <div class="flex justify-end mt-5">
                    <button type="button" id="btn-isi-harga"
                        class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-red-900 focus:outline-none bg-white rounded-lg border border-red-200 hover:bg-red-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-red-100 dark:focus:ring-red-700 dark:bg-red-800 dark:text-red-400 dark:border-red-600 dark:hover:text-white dark:hover:bg-red-700">Isi
                        Harga</button>
                </div>
            </div>
            <div class=" bg-white shadow-md rounded-md p-5 mb-5">
                <h1 class="text-xl poppins-medium mb-5">Pengisian Harga</h1>
                <div class="" id="container-detail-price-form"></div>
            </div>
            <div class="mt-5 flex justify-center">
                <button type="submit"
                    class="w-1/2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Tambah</button>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $("#add-sub-variant").click(addSubvariant);
        $(".btn-delete-sub-variant").click(deleteSubvariant);
        $("#variant-1").change(function() {
            getDetailVariant("1", $(this));
        });
        $("#variant-2").change(function() {
            getDetailVariant("2", $(this));
        });
        $("#btn-isi-harga").click(generatePriceForm);

        function addSubvariant() {
            const subvariant = `
            <div class="mb-5 flex items-end gap-4">
                <div class="w-full">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Detail Varian
                    </label>
                    <input type="text" id="name" name="detail_variant_name[]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                        required />
                </div>
                <div class="">
                    <button type="button"
                        class="btn-delete-sub-variant bg-white border border-red-700 text-red-700 hover:bg-red-100 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-3">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
            `;

            $("#more-sub-variant").append(subvariant);
            $(".btn-delete-sub-variant").click(deleteSubvariant);
        }

        function deleteSubvariant() {
            $(this).parent().parent().remove();
        }

        function getDetailVariant(number, self) {
            const variantID = self.val();
            if (variantID == "") {
                $(`#container-variant-detail-${number}`).html("");
                $(`#hint-text-variant-detail-${number}`).show();
            } else {
                $.ajax({
                    type: "GET",
                    url: `/admin/variant/show/${variantID}`,
                    success: function(response) {
                        const variant_details = response.variant_details;
                        $(`#container-variant-detail-${number}`).html("");
                        $(`#hint-text-variant-detail-${number}`).hide();
                        let html = "";
                        variant_details.forEach((detail, i) => {
                            html += `
                        <div class="flex items-center mb-4">
                            <input id="checkbox-variant-detail-${number}-${i}" type="checkbox" name="variant-detail[]" value="${detail.id}"
                                class="checkbox-variant-detail-${number} w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-red-500">
                            <label for="checkbox-variant-detail-${number}-${i}"
                                class="ms-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                                ${detail.name}
                            </label>
                        </div>
                        `;
                        });
                        $(`#container-variant-detail-${number}`).html(html);
                    }
                });
            }
        }

        function generatePriceForm() {
            const dataVariants1 = [...$(`.checkbox-variant-detail-1:checked`)].map(el => ({
                id: el.value,
                label: $(`label[for=${el.id}]`).text().trim()
            }));

            const dataVariants2 = [...$(`.checkbox-variant-detail-2:checked`)].map(el => ({
                id: el.value,
                label: $(`label[for=${el.id}]`).text().trim()
            }));

            if (dataVariants1.length == 0 && dataVariants2.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Silahkan pilih minimal 1 varian',
                });
            } else if (dataVariants1.length > 0 && dataVariants2.length == 0) {
                let html = "";
                dataVariants1.forEach((variant1, i) => {
                    html += htmlFormPrice(variant1);
                });
                $("#container-detail-price-form").html(html);
            } else {
                let html = "";
                dataVariants1.forEach((variant1, i) => {
                    dataVariants2.forEach((variant2, j) => {
                        html += htmlFormPrice(variant1, variant2);
                    });
                });
                $("#container-detail-price-form").html(html);
            }
        }

        function htmlFormPrice(variant1, variant2) {
            return `
            <div class="grid grid-cols-6 gap-5">
                <input type="hidden" name="variant_id_1[]" value="${variant1.id}">
                <input type="hidden" name="variant_id_2[]" value="${variant2 ? variant2.id : ''}">
                <div class="mb-5">
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Varian 1
                    </label>
                    <input type="text" id="text" name="price_variant_1[]" value="${variant1.label}" readonly
                        class="bg-gray-200 curson-not-allowed border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        required />
                </div>
                <div class="mb-5">
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Variant 2
                    </label>
                    <input type="text" id="text" name="price_variant_2[]" value="${variant2 ? variant2.label : '-'}" readonly
                        class="bg-gray-200 curson-not-allowed border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        required />
                </div>
                <div class="mb-5">
                    <label for="number"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                    <input type="number" id="number" name="price[]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        required />
                </div>
                <div class="mb-5">
                    <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok
                        Awal</label>
                    <input type="number" id="number" name="price_stock[]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        required />
                </div>
                <div class="mb-5">
                    <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Berat (Gram)
                    </label>
                    <input type="number" id="number" name="price_weight[]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        required />
                </div>
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="file_input">Gambar</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="file_input" type="file" name="price_img[]" required>
                </div>
            </div>
            `;
        }
    </script>
@endsection
