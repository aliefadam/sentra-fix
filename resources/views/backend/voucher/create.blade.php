@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'before' => [
                'name' => 'Daftar Voucher',
                'url' => route('admin.voucher.index'),
            ],
            'current' => $title,
        ])
    </div>

    <form action="{{ route('admin.voucher.store') }}" method="POST">
        @csrf
        <div class="mt-5 w-1/2">
            <div class=" bg-white shadow-md rounded-md p-5 mb-5">
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Tersedia untuk
                    </label>
                    <div class="grid grid-cols-2 gap-5">
                        <div class="flex items-center ps-4 border border-gray-200 rounded-sm dark:border-gray-700">
                            <input required id="available-for-1" type="radio" value="Diskon Total Transaksi"
                                name="available_for"
                                class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="available-for-1"
                                class="w-full py-3.5 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Diskon Total Transaksi
                            </label>
                        </div>
                        <div class="flex items-center ps-4 border border-gray-200 rounded-sm dark:border-gray-700">
                            <input required id="available-for-2" type="radio" value="Gratis Ongkos Kirim"
                                name="available_for"
                                class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="available-for-2"
                                class="w-full py-3.5 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Gratis Ongkos Kirim
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Kode Voucher
                    </label>
                    <input type="text" id="code" name="code"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500"
                        required />
                    <span class="text-gray-700 text-xs">
                        <i class="fa-regular fa-info-circle"></i> Harap gunakan huruf kapital semua tanpa spasi
                    </span>
                </div>
                <div id="container-detail">
                    <div class="mb-5">
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Unit
                        </label>
                        <div class="grid grid-cols-2 gap-5">
                            <div class="flex items-center ps-4 border border-gray-200 rounded-sm dark:border-gray-700">
                                <input id="unit-1" type="radio" value="Persen" name="unit"
                                    class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="unit-1"
                                    class="w-full py-3.5 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Persen (%)
                                </label>
                            </div>
                            <div class="flex items-center ps-4 border border-gray-200 rounded-sm dark:border-gray-700">
                                <input id="unit-2" type="radio" value="Rupiah" name="unit"
                                    class="w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="unit-2"
                                    class="w-full py-3.5 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Rupiah (Rp)
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label for="nominal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nominal (Rp)
                        </label>
                        <input type="text" id="nominal" name="nominal"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500" />
                        <span class="text-gray-700 text-xs">
                            <i class="fa-regular fa-info-circle"></i> Masukkan sesuai unit (Contoh • Persen: 10, Rupiah:
                            50000)
                        </span>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="minimal_transaction" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Minimal Pembelian (Rp)
                    </label>
                    <input type="text" id="minimal_transaction" name="minimal_transaction"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500" />
                    <span class="text-gray-700 text-xs">
                        <i class="fa-regular fa-info-circle"></i> Masukkan 0 jika tidak diperlukan minimal pembelian
                    </span>
                </div>
                <div class="mb-5">
                    <label for="maximal_used" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Maksimal Pemakaian
                    </label>
                    <input type="text" id="maximal_used" name="maximal_used"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500" />
                    <span class="text-gray-700 text-xs">
                        <i class="fa-regular fa-info-circle"></i> Masukkan 0 jika voucher bisa digunakan berapa orangpun
                    </span>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="w-full text-white bg-pink-700 hover:bg-pink-800 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-pink-600 dark:hover:bg-pink-700 focus:outline-none dark:focus:ring-pink-800">Tambah</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        $("input[name=available_for]").change(showDetail);

        function showDetail() {
            const value = $(this).val();
            if (value == "Diskon Total Transaksi") {
                $("#container-detail").show();
                $("input[name=unit]").attr("disabled", false);
                $("input[name=nominal]").attr("disabled", false);
            } else {
                $("#container-detail").hide();
                $("input[name=unit]").attr("disabled", true);
                $("input[name=nominal]").attr("disabled", true);
            }
        }
    </script>
@endsection
