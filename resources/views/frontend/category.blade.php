@extends('layouts.user')
@section('content')
    <main class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="w-full md:w-64 flex-shrink-0">
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Filter</h3>

                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Warna</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-custom focus:ring-custom" />
                                <span class="ml-2 text-gray-700">Hitam</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-custom focus:ring-custom" />
                                <span class="ml-2 text-gray-700">Putih</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-custom focus:ring-custom" />
                                <span class="ml-2 text-gray-700">Abu-abu</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-custom focus:ring-custom" />
                                <span class="ml-2 text-gray-700">Biru</span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-3">Rentang Harga</h4>
                        <div class="space-y-2">
                            <label class="flex items-center"><input type="radio" name="price-range"
                                    class="text-custom focus:ring-custom" /><span class="ml-2 text-gray-700">Dibawah Rp
                                    50.000</span></label><label class="flex items-center"><input type="radio"
                                    name="price-range" class="text-custom focus:ring-custom" /><span
                                    class="ml-2 text-gray-700">Rp 50.000 - Rp 100.000</span></label><label
                                class="flex items-center"><input type="radio" name="price-range"
                                    class="text-custom focus:ring-custom" /><span class="ml-2 text-gray-700">Rp 100.000 - Rp
                                    500.000</span></label><label class="flex items-center"><input type="radio"
                                    name="price-range" class="text-custom focus:ring-custom" /><span
                                    class="ml-2 text-gray-700">Rp 500.000 - Rp 1.000.000</span></label><label
                                class="flex items-center"><input type="radio" name="price-range"
                                    class="text-custom focus:ring-custom" /><span class="ml-2 text-gray-700">Diatas Rp
                                    1.000.000</span></label>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <button class="w-full bg-custom text-white py-2 px-4 rounded-md hover:bg-custom/90 !rounded-button">
                            Terapkan Filter
                        </button>
                        <button
                            class="w-full bg-gray-100 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-200 !rounded-button">
                            Reset Filter
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <div class="mb-6 flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-900">Produk kategori Smartphone
                    </h2>
                    <select class="border-gray-300 rounded-md text-gray-700 text-sm focus:ring-custom focus:border-custom">
                        <option>Urutkan: Terbaru</option>
                        <option>Harga Tertinggi</option>
                        <option>Harga Terendah</option>
                        <option>Terlaris</option>
                    </select>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img src="{{ asset('imgs/p-2.png') }}" class="w-full h-48 object-cover" alt="Wireless Headphone" />
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900">
                                Wireless Headphone
                            </h3>
                            <p class="text-custom font-medium mt-1">Rp 2.499.000</p>
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="ml-1 text-sm text-gray-500">(95)</span>
                            </div>
                            <button
                                class="mt-4 w-full bg-custom text-sm text-white py-2.5 px-4 rounded-md bg-gradient-to-r from-black to-pink-400 hover:bg-custom/90 !rounded-button">
                                <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img src="{{ asset('imgs/p-1.png') }}" class="w-full h-48 object-cover" alt="Smartphone Pro Max" />
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900">
                                Smartphone Pro Max
                            </h3>
                            <p class="text-custom font-medium mt-1">Rp 12.999.000</p>
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="ml-1 text-sm text-gray-500">(128)</span>
                            </div>
                            <button
                                class="mt-4 w-full bg-custom text-sm text-white py-2.5 px-4 rounded-md bg-gradient-to-r from-black to-pink-400 hover:bg-custom/90 !rounded-button">
                                <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img src="{{ asset('imgs/p-3.png') }}" class="w-full h-48 object-cover"
                            alt="Smart Watch Series 5" />
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900">
                                Smart Watch Series 5
                            </h3>
                            <p class="text-custom font-medium mt-1">Rp 3.999.000</p>
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="ml-1 text-sm text-gray-500">(76)</span>
                            </div>
                            <button
                                class="mt-4 w-full bg-custom text-sm text-white py-2.5 px-4 rounded-md bg-gradient-to-r from-black to-pink-400 hover:bg-custom/90 !rounded-button">
                                <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img src="{{ asset('imgs/p-4.png') }}" class="w-full h-48 object-cover" alt="Tablet Pro 2023" />
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900">
                                Tablet Pro 2023
                            </h3>
                            <p class="text-custom font-medium mt-1">Rp 8.999.000</p>
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="ml-1 text-sm text-gray-500">(152)</span>
                            </div>
                            <button
                                class="mt-4 w-full bg-custom text-sm text-white py-2.5 px-4 rounded-md bg-gradient-to-r from-black to-pink-400 hover:bg-custom/90 !rounded-button">
                                <i class="fas fa-shopping-cart mr-2"></i>Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex items-center justify-between">
                    <div class="flex-1 flex justify-between md:hidden">
                        <button
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 !rounded-button">
                            Sebelumnya
                        </button>
                        <button
                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 !rounded-button">
                            Selanjutnya
                        </button>
                    </div>
                    <div class="hidden md:flex-1 md:flex md:items-center md:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium">1</span> sampai
                                <span class="font-medium">12</span> dari
                                <span class="font-medium">48</span> produk
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                aria-label="Pagination">
                                <button
                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 !rounded-button">
                                    <span class="sr-only">Sebelumnya</span>
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button
                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 !rounded-button">
                                    1
                                </button>
                                <button
                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-custom text-sm font-medium text-white !rounded-button">
                                    2
                                </button>
                                <button
                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 !rounded-button">
                                    3
                                </button>
                                <button
                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 !rounded-button">
                                    4
                                </button>
                                <button
                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 !rounded-button">
                                    <span class="sr-only">Selanjutnya</span>
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
