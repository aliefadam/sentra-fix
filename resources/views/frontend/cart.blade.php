@extends('layouts.user')

@section('content')
    <main class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">
                Keranjang Belanja (2 Item)
            </h1>
            <button class="text-custom hover:text-custom-dark">
                <i class="fas fa-trash-alt mr-2"></i>Hapus Semua
            </button>
        </div>
        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-12 md:col-span-8">
                <div class="bg-white rounded-lg shadow-md divide-y">
                    <div class="p-6 flex items-center gap-4 relative">
                        <div class="absolute left-3">
                            <input type="checkbox" class="w-5 h-5 rounded border-gray-600 text-custom focus:ring-custom" />
                        </div>
                        <div class="flex-shrink-0 w-24 h-24 ml-6">
                            <img src="{{ asset('imgs/p-1.png') }}" alt="Smartphone Pro Max"
                                class="w-full h-full object-cover rounded shadow-md" />
                        </div>
                        <div class="ml-6 flex-1">
                            <h3 class="text-lg font-medium text-gray-900">
                                Smartphone Pro Max
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">Hitam, 256GB</p>
                            <div class="mt-4 flex items-center">
                                <span class="text-lg font-medium text-gray-900">Rp 12.999.000</span>
                                <div class="ml-auto flex items-center border rounded-lg">
                                    <button class="px-3 py-1 text-gray-600 hover:text-custom !rounded-button">
                                        -
                                    </button>
                                    <span class="px-3 py-1 border-x">1</span>
                                    <button class="px-3 py-1 text-gray-600 hover:text-custom !rounded-button">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 flex items-center gap-4 relative">
                        <div class="absolute left-3">
                            <input type="checkbox" class="w-5 h-5 rounded border-gray-600 text-custom focus:ring-custom" />
                        </div>
                        <div class="flex-shrink-0 w-24 h-24 ml-6">
                            <img src="{{ asset('imgs/p-2.png') }}" alt="Wireless Headphone"
                                class="w-full h-full object-cover rounded shadow-md" />
                        </div>
                        <div class="ml-6 flex-1">
                            <h3 class="text-lg font-medium text-gray-900">
                                Wireless Headphone
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">Silver</p>
                            <div class="mt-4 flex items-center">
                                <span class="text-lg font-medium text-gray-900">Rp 2.499.000</span>
                                <div class="ml-auto flex items-center border rounded-lg">
                                    <button class="px-3 py-1 text-gray-600 hover:text-custom !rounded-button">
                                        -
                                    </button>
                                    <span class="px-3 py-1 border-x">1</span>
                                    <button class="px-3 py-1 text-gray-600 hover:text-custom !rounded-button">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        Ringkasan Belanja
                    </h2>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Harga (2 Barang)</span>
                            <span class="font-medium">Rp 14.997.000</span>
                        </div>

                        <div class="pt-4 border-t">
                            <div class="flex justify-between">
                                <span class="font-medium">Total Tagihan</span>
                                <span class="text-lg font-bold text-custom">Rp 17.047.000</span>
                            </div>
                        </div>

                        <button
                            class="w-full bg-gradient-to-r from-black to-pink-500 text-white py-3 font-medium !rounded-button hover:bg-custom-dark">
                            Lanjut ke Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
