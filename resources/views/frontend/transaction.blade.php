@extends('layouts.user')

@section('content')
    <main class="max-w-8xl mx-auto px-4 sm:px-4 lg:px-8 py-4 sm:py-8">
        <div class="flex lg:flex-row flex-col lg:gap-0 gap-3 justify-between items-center mb-8">
            <h1 class="text-2xl font-bold">Daftar Transaksi</h1>
            <div class="flex lg:flex-row flex-col gap-4 w-full lg:w-auto">
                <select class="border rounded-button px-4 py-2 bg-white">
                    <option value="">Semua Status</option>
                    <option value="pending">Menunggu Pembayaran</option>
                    <option value="processing">Diproses</option>
                    <option value="shipped">Dikirim</option>
                    <option value="completed">Selesai</option>
                    <option value="cancelled">Dibatalkan</option>
                </select>
                <div class="relative">
                    <input type="text" placeholder="Cari transaksi..."
                        class="border rounded-button w-full pl-10 pr-4 py-2" />
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
        </div>
        <div class="space-y-4">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex lg:flex-row flex-col justify-between items-start">
                    <div class="flex-1">
                        <div class="flex flex-col gap-4">
                            <div class="flex gap-4">
                                <img src="{{ asset('imgs/p-1.png') }}"
                                    class="w-24 h-24 object-cover rounded-lg shadow-md" />
                                <div>
                                    <h3 class="font-semibold text-lg">
                                        Mechanical Keyboard RGB
                                    </h3>
                                    <p class="text-gray-500">Quantity: 1</p>
                                    <p class="font-medium">Rp 1.299.000</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <img src="{{ asset('imgs/p-2.png') }}"
                                    class="w-24 h-24 object-cover rounded-lg shadow-md" />
                                <div>
                                    <h3 class="font-semibold text-lg">Gaming Mouse Pro</h3>
                                    <p class="text-gray-500">Quantity: 1</p>
                                    <p class="font-medium">Rp 899.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col lg:items-end w-full lg:w-auto lg:mt-0 mt-4">
                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm w-fit">Menunggu
                            Pembayaran</span>
                        <div class="mt-4 space-x-3 flex w-full">
                            <button
                                class="w-full lg:w-auto bg-custom text-white px-4 py-2 !rounded-button hover:bg-opacity-90">
                                Lihat Detail
                            </button>
                            <button
                                class="w-full lg:w-auto bg-red-50 text-red-600 px-4 py-2 !rounded-button hover:bg-red-100">
                                Batalkan
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border-t pt-3 mt-4 flex justify-between items-center">
                    <p class="font-medium">Total: Rp 2.198.000</p>
                    <p class="text-gray-500 mt-1 text-end">Belanja Pada 22 Januari 2024</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex lg:flex-row flex-col justify-between items-start">
                    <div class="flex-1">
                        <div class="flex flex-col gap-4">
                            <div class="flex gap-4">
                                <img src="{{ asset('imgs/p-3.png') }}"
                                    class="w-24 h-24 object-cover rounded-lg shadow-md" />
                                <div>
                                    <h3 class="font-semibold text-lg">
                                        Mechanical Keyboard RGB
                                    </h3>
                                    <p class="text-gray-500">Quantity: 1</p>
                                    <p class="font-medium">Rp 1.299.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col lg:items-end w-full lg:w-auto lg:mt-0 mt-4">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm w-fit">Diproses</span>
                        <div class="mt-4 space-x-3 flex w-full">
                            <button
                                class="w-full lg:w-auto bg-custom text-white px-4 py-2 !rounded-button hover:bg-opacity-90">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border-t pt-3 mt-4 flex justify-between items-center">
                    <p class="font-medium">Total: Rp 2.198.000</p>
                    <p class="text-gray-500 mt-1 text-end">Belanja Pada 22 Januari 2024</p>
                </div>
            </div>
        </div>
    </main>
@endsection
