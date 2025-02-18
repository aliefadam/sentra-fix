@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
        {{-- <a href="{{ route('admin.variant.create') }}"
            class="text-white bg-pink-600 border border-pink-600 hover:bg-pink-700 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Tambah Varian
        </a> --}}
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
                            Nama Toko
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Jumlah Produk Dijual
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Bergabung Pada
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stores as $store)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $store->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $store->user->products->count() }}
                            </td>
                            <td class="px-6 py-4">
                                {{ showingDays($store->created_at) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="{{ getStatusStoreBadges($store->status) }}">
                                    {{ getStatusStore($store->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex gap-4">
                                <a href="{{ route('admin.variant.edit', $store->id) }}"
                                    class="font-medium text-blue-600 hover:underline">Lihat Detail
                                </a>
                                @if ($store->status == 'waiting')
                                    <a href="javascript:void(0)" data-store-id="{{ $store->id }}"
                                        class="btn-confirm font-medium text-green-600 hover:underline">
                                        Konfirmasi
                                    </a>
                                @elseif($store->status == 'active')
                                    <a href="javascript:void(0)" data-variant-id="{{ $store->id }}"
                                        class="btn-delete-variant font-medium text-red-600 hover:underline">
                                        Nonaktifkan
                                    </a>
                                @else
                                    <a href="javascript:void(0)" data-variant-id="{{ $store->id }}"
                                        class="btn-delete-variant font-medium text-green-600 hover:underline">
                                        Aktifkan
                                    </a>
                                @endif
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
        $(".btn-confirm").click(confirm);

        function confirm() {
            const storeID = $(this).data("store-id");
            Swal.fire({
                icon: "warning",
                title: "Konfirmasi",
                text: "Apakah anda yakin ingin mengkonfirmasi toko ini?",
                showDenyButton: true,
                confirmButtonColor: "#198754",
                confirmButtonText: "Ya, Yakin!",
                denyButtonText: `Batal`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
                        url: `/admin/seller/${storeID}/confirm`,
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
                            if (response.message === "success") {
                                location.reload();
                            }
                        }
                    });
                }
            });

        }
    </script>
@endsection
