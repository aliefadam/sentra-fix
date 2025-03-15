@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'before' => [
                'name' => 'Daftar Produk',
                'url' => route('seller.product.index'),
            ],
            'current' => $title,
        ])
    </div>

    <form action="{{ route('seller.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mt-5 w-full">
            <div class=" bg-white shadow-md rounded-md p-5 mb-5">
                <h1 class="text-xl poppins-medium mb-5">Data Produk</h1>
                <div class="grid grid-cols-2 gap-5">
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Produk</label>
                        <input type="text" id="name" name="name" value="{{ $product->name }}"
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
                                <option value="{{ $sub_category->id }}" @selected($sub_category->id == $product->sub_category_id)>
                                    {{ $sub_category->name }}</option>
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
                        placeholder="Tulis deskripsi produk...">{{ $product->description }}</textarea>
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
                            @foreach ($variants as $index => $variant)
                                <option value="{{ $variant->id }}"
                                    {{ $variant->id == $product->productDetails[0]->variant1->variant->id ? 'selected' : '' }}>
                                    {{ $variant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <label for="variant_detail" class="block mb-3 text-sm font-medium text-gray-900 dark:text-white">
                            Detail Varian 1
                        </label>
                        <div class="text-gray-600 text-sm hidden" id="hint-text-variant-detail-1">Silahkan pilih jenis
                            variant
                            terlebih
                            dahulu</div>
                        <div class="grid grid-cols-3" id="container-variant-detail-1">
                            @foreach ($variant1_selected as $index => $variant)
                                <div class="flex items-center mb-4">
                                    @php
                                        $isChecked =
                                            isset($product->productDetails) &&
                                            $product->productDetails->contains('variant1_id', $variant->id);
                                    @endphp
                                    <input @checked($isChecked) id="checkbox-variant-detail-1-{{ $index }}"
                                        type="checkbox" name="variant-detail[]" value="{{ $variant->id }}"
                                        class="checkbox-variant-detail-1 w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-red-500">
                                    <label for="checkbox-variant-detail-1-{{ $index }}"
                                        class="ms-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                                        {{ $variant->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
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
                                @if (isset($product->productDetails[0]->variant2))
                                    <option value="{{ $variant->id }}"
                                        {{ $variant->id == $product->productDetails[0]->variant2->variant->id ? 'selected' : '' }}>
                                        {{ $variant->name }}</option>
                                @else
                                    <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <label for="variant_detail" class="block mb-3 text-sm font-medium text-gray-900 dark:text-white">
                            Detail Varian 2
                        </label>
                        <div class="text-gray-600 text-sm {{ isset($product->productDetails[0]->variant2) ? 'hidden' : '' }}"
                            id="hint-text-variant-detail-2">Silahkan pilih jenis
                            variant
                            terlebih
                            dahulu</div>
                        <div class="grid grid-cols-3" id="container-variant-detail-2">
                            @foreach ($variant2_selected as $index => $variant)
                                <div class="flex items-center mb-4">
                                    @php
                                        $isChecked =
                                            isset($product->productDetails) &&
                                            $product->productDetails->contains('variant2_id', $variant->id);
                                    @endphp
                                    <input @checked($isChecked) id="checkbox-variant-detail-2-{{ $index }}"
                                        type="checkbox" name="variant-detail[]" value="{{ $variant->id }}"
                                        class="checkbox-variant-detail-2 w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-red-500">
                                    <label for="checkbox-variant-detail-2-{{ $index }}"
                                        class="ms-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                                        {{ $variant->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-5">
                    <button type="button" id="btn-isi-harga" data-product-id="{{ $product->id }}"
                        class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-red-900 focus:outline-none bg-white rounded-lg border border-red-200 hover:bg-red-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-red-100 dark:focus:ring-red-700 dark:bg-red-800 dark:text-red-400 dark:border-red-600 dark:hover:text-white dark:hover:bg-red-700">Isi
                        Harga</button>
                </div>
            </div>
            <div class=" bg-white shadow-md rounded-md p-5 mb-5">
                <h1 class="text-xl poppins-medium mb-5">Pengisian Harga</h1>
                <div class="" id="container-detail-price-form">
                    @foreach ($product->productDetails as $detail)
                        <div class="grid grid-cols-6 gap-5">
                            <div class="mb-5">
                                <input type="hidden" name="variant_id_1[]" value="{{ $detail->variant1_id }}">
                                <input type="hidden" name="variant_id_2[]" value="{{ $detail->variant2_id }}">
                                <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Varian 1
                                </label>
                                <input type="text" id="text" name="price_variant_1[]"
                                    value="{{ $detail->variant1->name }}" readonly
                                    class="bg-gray-200 curson-not-allowed border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                    required />
                            </div>
                            <div class="mb-5">
                                <label for="text"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Variant 2
                                </label>
                                <input type="text" id="text" name="price_variant_2[]"
                                    value="{{ $detail->variant2 ? $detail->variant2->name : '-' }}" readonly
                                    class="bg-gray-200 curson-not-allowed border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                    required />
                            </div>
                            <div class="mb-5">
                                <label for="number"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                                <input type="number" id="number" name="price[]" value="{{ $detail->price }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                    required />
                            </div>
                            <div class="mb-5">
                                <label for="number"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok
                                </label>
                                <input type="number" id="number" name="price_stock[]" value="{{ $detail->stock }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                    required />
                            </div>
                            <div class="mb-5">
                                <label for="weight"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Berat (Gram)
                                </label>
                                <input type="number" id="weight" name="price_weight[]"
                                    value="{{ $detail->weight }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                    required />
                            </div>
                            <div class="mb-5">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="file_input">Gambar</label>
                                <div class="flex items-center gap-3">
                                    @if ($detail->image != '')
                                        <img class="size-10 object-cover rounded-md shadow-md"
                                            src="/uploads/products/{{ $detail->image }}" alt="">
                                    @endif
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        id="file_input" type="file" name="price_img[]">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class=" bg-white shadow-md rounded-md p-5 mb-5 w-1/2">
                <div class="flex justify-between mb-5">
                    <h1 class="text-xl poppins-medium">Gambar Tambahan</h1>
                    <button type="button" id="btn-add-image-input"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <div class="space-y-5" id="container-image-input">
                    @foreach ($imageProducts as $image)
                        <div class="">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_input">Upload
                                file</label>
                            <img src="/uploads/products/{{ $image->image }}"
                                class="size-20 object-cover rounded-md shadow-md mb-5" alt="">
                            <div class="flex justify-between gap-3">
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                                    id="file_input" name="more-image[{{ $image->id }}]" type="file">
                                <button type="button" id="" data-id="{{ $image->id }}"
                                    class="btn-delete-image-input-database text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-5 flex justify-center">
                <button type="submit"
                    class="w-1/2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Simpan</button>
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

        $("#btn-add-image-input").click(addImageInput);
        $(".btn-delete-image-input").click(deleteImageInput);
        $(".btn-delete-image-input-database").click(deleteImageInputDatabase);

        function addImageInput() {
            const imageInput = `
            <div class="">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                    file</label>
                <div class="flex justify-between gap-3">
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                        id="file_input" name="more-image-new[]" type="file" required>
                    <button type="button" id=""
                        class="btn-delete-image-input text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
            `;

            $("#container-image-input").append(imageInput);
            $(".btn-delete-image-input").click(deleteImageInput);
        }

        function deleteImageInput() {
            $(this).parent().parent().remove();
        }

        function deleteImageInputDatabase() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Anda yakin?',
                text: "Data akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/image-product/${id}`,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
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
                        success: function(data) {
                            window.location.reload();
                        },
                    });
                }
            });
        }

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
            } else {
                const productID = $(this).data("product-id");
                $.ajax({
                    type: "POST",
                    url: `/admin/product/price-form/${productID}`,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        dataVariants1: dataVariants1,
                        dataVariants2: dataVariants2
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
                        const html = response.html;
                        $("#container-detail-price-form").html(html);
                    }
                });
            }

        }

        function htmlFormPrice(variant1, variant2) {
            return `
            <div class="grid grid-cols-5 gap-5">
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
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="file_input">Gambar</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="file_input" type="file" name="price_img[]">
                </div>
            </div>
            `;
        }
    </script>
@endsection
