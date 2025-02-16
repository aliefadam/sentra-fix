@extends('layouts.user')

@section('content')
    <main class="max-w-8xl mx-auto px-4 sm:px-4 lg:px-8 py-4 sm:py-8">
        <div class="flex lg:flex-row flex-col lg:gap-0 gap-3 justify-between items-center mb-8">
            <h1 class="text-2xl font-bold">Daftar Transaksi</h1>
            <div class="flex lg:flex-row flex-col gap-4 w-full lg:w-auto">
                <select id="countries"
                    class="bg-white border border-gray-500 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500">
                    <option selected>Semua Status</option>
                    <option value="US">Menunggu Pembayaran</option>
                    <option value="CA">Pembayaran Berhasil</option>
                    <option value="FR">Pesanan dikonfirmasi</option>
                </select>
            </div>
        </div>
        <div class="space-y-4">
            @foreach ($transactions as $transaction)
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex lg:flex-row flex-col justify-between items-start">
                        <div class="flex-1">
                            <div class="flex flex-col gap-4">
                                @foreach ($transaction->transactionDetails as $detail)
                                    <div class="flex gap-4">
                                        <img src="/uploads/products/{{ $detail->product_image }}"
                                            class="w-24 h-24 object-cover rounded-lg shadow-md" />
                                        <div>
                                            <h3 class="font-semibold text-lg">
                                                {{ $detail->product_name }}
                                            </h3>
                                            <p class="text-sm text-gray-900">
                                                {{ $detail->variant }}
                                            </p>
                                            <p class="font-medium text-gray-700 mt-3">
                                                {{ $detail->qty }}
                                                x
                                                {{ format_rupiah($detail->product_price, true) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex flex-col lg:items-end w-full lg:w-auto lg:mt-0 mt-4">
                            <span class="{{ getStatusBadges($transaction->status) }}">
                                {{ getStatus($transaction->status) }}
                            </span>
                            <div class="mt-6 space-x-3 flex w-full">
                                <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal"
                                    data-transaction-id="{{ $transaction->id }}"
                                    class="btn-detail-transaction text-white bg-pink-700 hover:bg-pink-800 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-pink-600 dark:hover:bg-pink-700 focus:outline-none dark:focus:ring-pink-800">
                                    Lihat Detail Pesanan
                                </button>
                                @if ($transaction->status == 'waiting')
                                    <button type="button"
                                        class="bg-white border border-red-700  text-red-700 hover:bg-red-50 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                        Batalkan Pesanan
                                    </button>
                                @elseif($transaction->status == 'delivery')
                                    <button type="button" data-transaction-id="{{ $transaction->id }}"
                                        class="btn-konfirmasi-pesanan-sampai text-purple-700 bg-white border border-purple-700 hover:bg-purple-50 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.50">
                                        Konfirmasi Pesanan Sampai
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="border-t pt-3 mt-4 flex justify-between items-center">
                        <p class="font-medium">
                            Total: {{ format_rupiah($transaction->total, true) }}</p>
                        <p class="text-gray-700 mt-1 text-end text-sm">Belanja Pada
                            {{ showingDays($transaction->created_at) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Detail Pesanan
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4 scrollbar h-[500px] overflow-y-auto" id="modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".btn-detail-transaction").click(detailTransaction);
        $(".btn-konfirmasi-pesanan-sampai").click(confirmTransaction);

        function detailTransaction() {
            const transactionId = $(this).data('transaction-id');
            $.ajax({
                type: "GET",
                url: `/transaction/${transactionId}`,
                beforeSend: function() {
                    $("#modal-body").html(`
                    <div class="flex justify-center items-center h-full py-5">
                        <div role="status">
                            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-pink-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    `);
                },
                success: function(response) {
                    const html = response.html;
                    $("#modal-body").html(html);
                }
            });
        }

        function confirmTransaction() {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah anda yakin telah menerima paket ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, yakin!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    const transactionId = $(this).data('transaction-id');
                    $.ajax({
                        type: "PUT",
                        url: `/transaction/${transactionId}/done`,
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: "Loading",
                                text: "Memproses permintaan anda...",
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
