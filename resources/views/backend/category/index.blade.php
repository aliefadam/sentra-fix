@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => 'Daftar Kategori',
        ])
        <a href="{{ route('admin.category.create') }}"
            class="text-white bg-red-600 border border-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Tambah Kategori
        </a>
    </div>

    <div class="mt-5">
        <div class="relative overflow-x-auto rounded-md bg-white shadow-md">
            <table id="data-table" class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-400">
                <thead class="text-xs text-red-600 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                    <tr class="bg-white border-b border-t border-gray-200">
                        <th scope="col" class="px-6 py-4">
                            No
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Icon
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Nama Kategori
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Sub Kategori
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                <i class="{{ $category->icon }}"></i>
                            </td>
                            <td class="px-6 py-4">
                                {{ $category->name }}
                            </td>
                            <td class="px-6 py-4">
                                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside">
                                    @foreach ($category->subCategories as $subCategory)
                                        <li>
                                            {{ $subCategory->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 py-4 flex gap-4">
                                <a href="{{ route('admin.category.edit', $category->id) }}"
                                    class="font-medium text-blue-600 hover:underline">Edit</a>
                                <a href="javascript:void(0)" data-category-id="{{ $category->id }}"
                                    class="btn-delete-category font-medium text-red-600 hover:underline">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".btn-delete-category").click(deleteCategory);

        function deleteCategory() {
            const categoryID = $(this).data("category-id");
            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah anda yakin ingin menghapus kategori ini?",
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
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        url: `/admin/category/${categoryID}`,
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                }
            });
        }
    </script>
@endsection
