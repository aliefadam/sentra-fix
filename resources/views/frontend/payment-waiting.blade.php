@extends('layouts.user')

@section('content')
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8 max-w-4xl">
        <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 md:p-8">
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-yellow-50 mb-4">
                    <i class="fas fa-clock text-2xl text-yellow-500"></i>
                </div>
                <h1 class="text-xl sm:text-2xl font-semibold">Menunggu Pembayaran</h1>
            </div>
            <div class="border rounded-lg p-4 sm:p-6 mb-4 sm:mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-600">Batas Akhir Pembayaran</p>
                        <p class="font-medium">{{ showingDays($transaction->due_date) }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Sisa Waktu</p>
                        <p class="font-medium text-xl" data-due-date="{{ $transaction->due_date }}" id="countdown">
                            Menghitung...
                        </p>
                    </div>
                </div>
            </div>
            <div class="border rounded-lg p-4 sm:p-6 mb-4 sm:mb-6">
                @php
                    $payment = json_decode($transaction->payment);
                    $payment_type = $payment->type;
                    $payment_name = $payment->name;
                    $data = $payment->data;
                @endphp
                <h2 class="font-semibold mb-4">{{ $payment_type }} {{ $payment_name }}</h2>
                <div class="bg-gray-50 shadow-md p-3 sm:p-4 rounded-lg mb-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Nomor Virtual Account</p>
                            <p class="font-mono text-base sm:text-lg font-medium">{{ $data }}</p>
                        </div>
                        <button type="button" data-virtual-account="{{ $data }}"
                            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-xs px-5 py-2.5 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                            <i class="fa-solid fa-copy"></i>
                            Salin
                        </button>
                    </div>
                </div>
            </div>

            <div class="border rounded-lg p-4 sm:p-6 mb-4 sm:mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-600">Total Pembayaran</p>
                        <p class="font-medium">{{ format_rupiah($transaction->total, true) }}</p>
                    </div>
                    <div class="text-right">
                        <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal"
                            class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 font-medium rounded-lg text-xs px-5 py-2.5 text-center">Lihat
                            Detail Pesanan</button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('transaction') }}"
                    class="text-white bg-pink-700 hover:bg-pink-800 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-3 text-center w-full dark:bg-pink-600 dark:hover:bg-pink-700 focus:outline-none dark:focus:ring-pink-800">
                    Lihat Daftar Transaksi
                </a>
                <a href="{{ route('home') }}"
                    class="bg-white border border-pink-700 text-pink-700 hover:bg-pink-50 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-3 text-center w-full dark:bg-pink-600 dark:hover:bg-pink-700 focus:outline-none dark:focus:ring-pink-800">
                    Kembali ke beranda
                </a>
            </div>
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
                <div class="p-4 md:p-5 space-y-4 scrollbar h-[500px] overflow-y-auto">
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="lg:text-sm text-xs ">Status</span>
                            <span class="lg:text-sm text-xs text-gray-600">{{ getStatus($transaction->status) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="lg:text-sm text-xs ">No Invoice</span>
                            <span class="lg:text-sm text-xs text-gray-600">{{ $transaction->invoice }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="lg:text-sm text-xs ">Tanggal Pembelian</span>
                            <span class="lg:text-sm text-xs text-gray-600 text-right">
                                {{ showingDays($transaction->created_at) }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="lg:text-sm text-xs flex-[3]">Metode Pembayaran</span>
                            <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                                {{ $payment_type }} {{ $payment_name }}
                            </span>
                        </div>
                        @if ($payment_type != 'QRIS')
                            <div class="flex justify-between">
                                <span class="lg:text-sm text-xs flex-[3]">Virtual Account</span>
                                <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                                    {{ $data }}
                                </span>
                            </div>
                        @else
                            <div class="flex justify-end">
                                {!! showQR($data['virtual_account'], 100) !!}
                            </div>
                        @endif
                    </div>
                    <hr>
                    <div class="">
                        <h1 class="poppins-semibold">Detail Produk</h1>
                        <div class="mt-4 flex flex-col gap-4">
                            @foreach ($transaction->transactionDetails as $detail)
                                <div class="flex gap-3 border shadow-sm rounded-lg p-3">
                                    <div class="flex-[2]">
                                        <div class="flex gap-2">
                                            <img src="/uploads/products/{{ $detail->product_image }}"
                                                class="w-[80px] h-[80px] object-cover rounded-md">
                                            <div class="flex flex-col">
                                                <span class="poppins-medium lg:text-base text-sm block leading-[17px]">
                                                    {{ $detail->product_name }}
                                                </span>
                                                <span class="text-xs capitalize poppin-semibold text-gray-500 lg:mt-0 mt-2">
                                                    {{ $detail->variant }}
                                                </span>
                                                <span class="lg:text-sm text-xs mt-2">
                                                    {{ $detail->qty }} Barang
                                                    X
                                                    {{ format_rupiah($detail->product_price, true) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mt-3 lg:text-sm text-xs">Catatan : </div>
                                        <div class="mt-1 lg:text-sm text-xs poppins-medium">
                                            {{ $detail->notes }}
                                        </div>
                                    </div>
                                    <div class="flex-[1] flex flex-col gap-1 items-end">
                                        <span class="lg:text-sm text-xs text-right">Total Harga Barang</span>
                                        <span class="poppins-semibold leading-none lg:text-base text-sm">
                                            {{ format_rupiah($detail->total, true) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="space-y-4">
                        <h1 class="poppins-semibold">Informasi Alamat</h1>
                        <div class="flex justify-between">
                            <span class="lg:text-sm text-xs flex-[3]">Alamat</span>
                            <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                                {{ $transaction->shipping_address }}
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="space-y-4">
                        <h1 class="poppins-semibold">Informasi Pengiriman</h1>
                        <div class="flex justify-between">
                            <span class="lg:text-sm text-xs flex-[3]">Layanan</span>
                            <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end uppercase">
                                {{ $transaction->shipping_service }}
                            </span>
                        </div>
                        @if (isset($transaction->shipping_service))
                            <div class="flex justify-between">
                                <span class="lg:text-sm text-xs flex-[3]">No Resi</span>
                                <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end uppercase">
                                    {{ $transaction->shipping_code ?? '-' }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <hr>
                    <div class="space-y-4">
                        <h1 class="poppins-semibold">Rincian Pembayaran</h1>
                        <div class="flex justify-between">
                            <span class="lg:text-sm text-xs flex-[3]">
                                Total Harga
                            </span>
                            <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                                {{ format_rupiah($transaction->sub_total_product, true) }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="lg:text-sm text-xs flex-[3]">Total Ongkos Kirim</span>
                            <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                                {{ format_rupiah($transaction->shipping_cost, true) }}
                            </span>
                        </div>
                        <div class="flex justify-between poppins-semibold">
                            <span class="text-[15px] flex-[3]">Total Belanja</span>
                            <span
                                class="text-[15px] flex-[2] text-gray-600 text-end">{{ format_rupiah($transaction->total, true) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text);
        }

        function updateCountdown() {
            const now = new Date();
            const target = new Date($("#countdown").data('due-date'));

            function pad(n) {
                return n < 10 ? '0' + n : n;
            }

            setInterval(() => {
                const now = new Date();
                const diff = target - now;

                const hours = Math.floor(diff / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                $('#countdown').text(`${pad(hours)}:${pad(minutes)}:${pad(seconds)}`);
            }, 1000);
        }
        updateCountdown();
    </script>
@endsection
