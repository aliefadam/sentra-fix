@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => 'Daftar Kategori',
        ])
        <a href="{{ route('admin.product.create') }}"
            class="text-white bg-pink-600 border border-pink-600 hover:bg-pink-700 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Tambah Produk
        </a>
    </div>

    <div class="mt-5">
        <div class="relative overflow-x-auto rounded-md bg-white shadow-md">
            <table id="data-table" class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-400">
                <thead class="text-xs text-pink-600 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                    <tr class="bg-white border-b border-t border-gray-200">
                        <th scope="col" class="px-6 py-4">
                            No
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Nama Produk
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Varian
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-4">
                                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside">
                                    @foreach ($product->productDetails as $subproduct)
                                        <li>
                                            {{ $subproduct->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 py-4 flex gap-4">
                                <a href="{{ route('admin.product.edit', $product->id) }}"
                                    class="font-medium text-blue-600 hover:underline">Edit</a>
                                <a href="javascript:void(0)" data-product-id="{{ $product->id }}"
                                    class="btn-delete-product font-medium text-red-600 hover:underline">Hapus</a>
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
        $(".btn-delete-product").click(deleteproduct);

        function deleteproduct() {
            const productID = $(this).data("product-id");
            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah anda yakin ingin menghapus varian ini?",
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
                        url: `/admin/product/${productID}`,
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                }
            });
        }
    </script>
@endsection
