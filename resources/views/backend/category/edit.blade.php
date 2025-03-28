@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'before' => [
                'name' => 'Daftar Kategori',
                'url' => route('admin.category.index'),
            ],
            'current' => $title,
        ])
        <a href="{{ route('admin.category.create') }}"
            class="text-white bg-red-600 border border-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Tambah Kategori
        </a>
    </div>

    <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mt-5 w-1/2">
            <div class=" bg-white shadow-md rounded-md p-5 mb-5">
                <h1 class="text-lg mb-5 poppins-medium">Kategori Utama</h1>
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Kategori</label>
                    <input type="text" id="name" name="name" value="{{ $category->name }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        required />
                </div>
                <div class="mb-5">
                    <label for="icon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Icon (lihat
                        ikon pada <a href="https://fontawesome.com/search" target="_blank"
                            class="text-red-500 hover:text-red-600">Font Awesome</a>)</label>
                    <input type="text" id="icon" name="icon" value="{{ $category->icon }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        placeholder="fa-solid fa-user" required />
                </div>
            </div>
            <div class="bg-white shadow-md rounded-md p-5">
                <div class="flex justify-between items-center">
                    <h1 class="text-lg mb-5 poppins-medium">Sub Kategori</h1>
                    <button type="button" id="add-sub-category"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Sub Kategori
                    </label>
                    <input type="text" id="name" name="sub_category_name_old[]"
                        value="{{ $category->subCategories[0]->name }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        required />
                </div>
                @foreach ($category->subCategories as $index => $subCategory)
                    @if ($index > 0)
                        <div class="mb-5 flex items-end gap-4">
                            <div class="w-full">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Nama Sub Kategori
                                </label>
                                <input type="text" id="name" name="sub_category_name_old[]"
                                    value="{{ $subCategory->name }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                                    required />
                            </div>
                            <div class="">
                                <button type="button" data-sub-category-id="{{ $subCategory->id }}"
                                    class="btn-delete-sub-category bg-white border border-red-700 text-red-700 hover:bg-red-100 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-3">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div id="more-sub-category"></div>
            </div>
            <div class="mt-5">
                <button type="submit"
                    class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Simpan</button>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $("#add-sub-category").click(addSubCategory);
        $(".btn-delete-sub-category").click(deleteSubCategory);
        $(".btn-delete-sub-category-without-confirm").click(deleteSubCategoryWithoutConfirm);

        function addSubCategory() {
            const subCategory = `
            <div class="mb-5 flex items-end gap-4">
                <div class="w-full">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Sub Kategori
                    </label>
                    <input type="text" id="name" name="sub_category_name[]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                        required />
                </div>
                <div class="">
                    <button type="button"
                        class="btn-delete-sub-category-without-confirm bg-white border border-red-700 text-red-700 hover:bg-red-100 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-3">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
            `;

            $("#more-sub-category").append(subCategory);
            $(".btn-delete-sub-category-without-confirm").click(deleteSubCategoryWithoutConfirm);
        }

        function deleteSubCategory() {
            const subCategoryID = $(this).data("sub-category-id");
            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah anda yakin ingin menghapus sub kategori ini?",
                showDenyButton: true,
                confirmButtonColor: "#198754",
                confirmButtonText: "Ya, Yakin!",
                denyButtonText: `Batal`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Loading...",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        type: "DELETE",
                        data: {
                            _token: $("[name='csrf-token']").attr("content"),
                        },
                        url: `/admin/sub_category/${subCategoryID}`,
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                }
            });
        }

        function deleteSubCategoryWithoutConfirm() {
            console.log("TE");

            $(this).parent().parent().remove();
        }
    </script>
@endsection
