@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => 'Daftar Produk',
        ])
        <a href="{{ route('seller.product.create') }}"
            class="text-white bg-pink-600 border border-pink-600 hover:bg-pink-700 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Tambah Produk
        </a>
    </div>

    <div class="mt-5">
        <div class="relative overflow-x-auto rounded-md bg-white shadow-md">
            <table id="data-table" class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-400">
                <thead class="text-xs text-pink-600 uppercase bg-white">
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
                                <div>
                                    {{ $product->name }}
                                </div>
                                <hr class="my-2">
                                <div class="poppins-semibold">
                                    <i class="fa-regular fa-store mr-1"></i> {{ $product->user->store->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase border-b">
                                        <tr class="bg-white">
                                            <td class="py-4 poppins-semibold text-gray-900">
                                                SKU
                                            </td>
                                            <td class="px-4 py-4 poppins-semibold text-gray-900">
                                                {{ $product->productDetails->first()->variant1->variant->name }}
                                            </td>
                                            @if ($product->productDetails->first()->variant2)
                                                <td class="px-4 py-4 poppins-semibold text-gray-900">
                                                    {{ $product->productDetails->first()->variant2->variant->name }}
                                                </td>
                                            @endif
                                            <td class="px-4 py-4 poppins-semibold text-gray-900">
                                                Harga
                                            </td>
                                            <td class="px-4 py-4 poppins-semibold text-gray-900">
                                                Stok
                                            </td>
                                            <td class="px-4 py-4 poppins-semibold text-gray-900">
                                                Gambar
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->productDetails as $detail)
                                            <tr class="bg-white">
                                                <td class="py-4 poppins-medium text-gray-700">
                                                    {{ $detail->sku }}
                                                </td>
                                                <td class="px-4 py-4">
                                                    {{ $detail->variant1->name }}
                                                </td>
                                                @if ($detail->variant2)
                                                    <td class="px-4 py-4">
                                                        {{ $detail->variant2->name }}
                                                    </td>
                                                @endif
                                                <td class="px-4 py-4">
                                                    {{ format_rupiah($detail->price, true) }}
                                                </td>
                                                <td class="px-4 py-4">
                                                    {{ $detail->stock }}
                                                </td>
                                                <td class="px-4 py-4">
                                                    <img class="size-16 object-cover rounded-md shadow-md"
                                                        src="{{ asset('uploads/products/' . $detail->image) }}"
                                                        alt="">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td class="px-6 py-4 flex gap-4">
                                <a href="{{ route('seller.product.edit', $product->id) }}"
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
                text: "Apakah anda yakin ingin menghapus produk ini?",
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
