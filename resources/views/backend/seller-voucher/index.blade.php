@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
        <a href="{{ route('seller.voucher.create') }}"
            class="text-white bg-pink-600 border border-pink-600 hover:bg-pink-700 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Tambah Voucher
        </a>
    </div>

    <div class="mt-5">
        <div class="relative overflow-x-auto rounded-md bg-white min-h-[500px] shadow-md">
            <table id="data-table" class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-400">
                <thead class="text-xs text-pink-600 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                    <tr class="bg-white border-b border-t border-gray-200">
                        <th scope="col" class="px-6 py-4">
                            No
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Kode Voucher
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Tersedia Untuk
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Nominal
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Telah Dipakai
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Minimal Pembelian
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
                    @foreach ($vouchers as $index => $voucher)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 poppins-medium">
                                {{ $voucher->code }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $voucher->available_for }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($voucher->nominal == null)
                                    -
                                @else
                                    @if ($voucher->unit == 'Persen')
                                        {{ $voucher->nominal }}%
                                    @else
                                        {{ format_rupiah($voucher->nominal, true) }}
                                    @endif
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $voucher->used }}
                                <span class="mx-1">/</span>
                                {{ $voucher->maximal_used == 0 ? 'Tanpa Batas' : $voucher->maximal_used }}
                            </td>
                            <td class="px-6 py-4">
                                {{ format_rupiah($voucher->minimal_transaction, true) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="{{ getStatusVoucherBadges($voucher->active) }}">
                                    {{ getStatusVoucher($voucher->active) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <button type="button" id="dropdownDefaultButton-{{ $index }}"
                                    data-dropdown-toggle="dropdown-{{ $index }}"
                                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>

                                <!-- Dropdown menu -->
                                <div id="dropdown-{{ $index }}"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-md w-44 dark:bg-gray-700">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownDefaultButton-{{ $index }}">
                                        @if ($voucher->active)
                                            <li>
                                                <a href="javascript:void(0)" data-voucher-id="{{ $voucher->id }}"
                                                    class="btn-deactivate block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Nonaktifkan</a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="javascript:void(0)" data-voucher-id="{{ $voucher->id }}"
                                                    class="btn-activate block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Aktifkan</a>
                                            </li>
                                        @endif
                                        <li>
                                            <a href="{{ route('seller.voucher.edit', $voucher->id) }}"
                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-voucher-id="{{ $voucher->id }}"
                                                class="btn-delete block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Hapus</a>
                                        </li>
                                    </ul>
                                </div>
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
        $(".btn-delete").click(deleteVoucher);

        function deleteVoucher() {
            const voucherID = $(this).data("voucher-id");
            Swal.fire({
                icon: "warning",
                title: "Konfirmasi",
                text: "Apakah anda yakin ingin menghapus voucher ini?",
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
                        url: `/seller/voucher/${voucherID}`,
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                }
            });
        }

        function deactivate() {
            const voucherID = $(this).data("voucher-id");
            Swal.fire({
                icon: "warning",
                title: "Konfirmasi",
                text: "Apakah anda yakin ingin menonaktifkan voucher ini?",
                showDenyButton: true,
                confirmButtonColor: "#198754",
                confirmButtonText: "Ya, Yakin!",
                denyButtonText: `Batal`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
                        url: `/seller/voucher/${voucherID}/deactivate`,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
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

        function activate() {
            const voucherID = $(this).data("voucher-id");
            Swal.fire({
                icon: "warning",
                title: "Konfirmasi",
                text: "Apakah anda yakin ingin mengaktifkan voucher ini?",
                showDenyButton: true,
                confirmButtonColor: "#198754",
                confirmButtonText: "Ya, Yakin!",
                denyButtonText: `Batal`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
                        url: `/seller/voucher/${voucherID}/activate`,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
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
