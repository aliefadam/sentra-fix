@extends('layouts.user')

@section('content')
    <main class="max-w-8xl mx-auto px-4 sm:px-4 lg:px-8 py-4 sm:py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 md:gap-8">
            <div class="space-y-4 lg:col-span-5">
                <div class="w-full h-[300px] lg:h-[500px] bg-gray-100 rounded-lg overflow-hidden shadow-md">
                    <img src="{{ asset('imgs/p-2.png') }}" class="w-full h-full object-center object-cover" />
                </div>
                <div class="grid grid-cols-4 gap-2 sm:gap-4">
                    <button class="aspect-w-1 aspect-h-1 bg-gray-100 rounded-lg overflow-hidden shadow-md">
                        <img src="{{ asset('imgs/p-2-2.png') }}" class="w-full h-full object-center object-cover" />
                    </button>
                    <button class="aspect-w-1 aspect-h-1 bg-gray-100 rounded-lg overflow-hidden shadow-md">
                        <img src="{{ asset('imgs/p-2-3.png') }}" class="w-full h-full object-center object-cover" />
                    </button>
                    <button class="aspect-w-1 aspect-h-1 bg-gray-100 rounded-lg overflow-hidden shadow-md">
                        <img src="{{ asset('imgs/p-2-4.png') }}" class="w-full h-full object-center object-cover" />
                    </button>
                    <button class="aspect-w-1 aspect-h-1 bg-gray-100 rounded-lg overflow-hidden shadow-md">
                        <img src="{{ asset('imgs/p-2-5.png') }}" class="w-full h-full object-center object-cover" />
                    </button>
                </div>
            </div>
            <div class="space-y-6 lg:col-span-7">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                        Wireless Headphone Pro
                    </h1>
                    <div class="mt-2 flex items-center">
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star-half-alt text-yellow-400"></i>
                        </div>
                        <span class="ml-2 text-sm text-gray-500">(95 ulasan)</span>
                    </div>
                </div>
                <div>
                    <p class="text-2xl sm:text-3xl font-bold text-custom">
                        Rp 2.499.000
                    </p>
                </div>
                <div class="border-t border-b border-gray-200 py-6">
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">Warna</h3>
                            <div class="mt-2 flex space-x-3">
                                <button class="w-8 h-8 rounded-full bg-gray-200 ring-2 ring-custom"></button>
                                <button class="w-8 h-8 rounded-full bg-black"></button>
                                <button class="w-8 h-8 rounded-full bg-blue-600"></button>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-900">Jumlah</h3>
                                <div class="flex items-center space-x-3">
                                    <button
                                        class="w-8 h-8 flex items-center justify-center border border-gray-300 !rounded-button">
                                        <i class="fas fa-minus text-sm"></i>
                                    </button>
                                    <span class="text-lg font-medium">1</span>
                                    <button
                                        class="w-8 h-8 flex items-center justify-center border border-gray-300 !rounded-button">
                                        <i class="fas fa-plus text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                    <button
                        class="flex-1 bg-gradient-to-r from-custom to-pink-500 text-white px-6 py-3 !rounded-button hover:bg-custom/90">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Tambah ke Keranjang
                    </button>
                    <a href="{{ route('product.checkout', ['slug' => 'wireless-headphone-pro']) }}"
                        class="text-center flex-1 bg-white border-2 border-custom text-custom px-6 py-3 !rounded-button hover:bg-gray-50">
                        Beli Sekarang
                    </a>
                </div>
                <div class="prose prose-sm max-w-none">
                    <h3 class="text-lg font-medium">Deskripsi Produk</h3>
                    <p>
                        Wireless Headphone Pro menghadirkan pengalaman mendengarkan musik
                        yang luar biasa dengan teknologi noise cancelling terbaru.
                        Dilengkapi dengan:
                    </p>
                    <ul>
                        <li>Driver 40mm dengan kualitas suara premium</li>
                        <li>Active Noise Cancelling untuk meredam suara luar</li>
                        <li>Baterai tahan hingga 30 jam</li>
                        <li>Konektivitas Bluetooth 5.0</li>
                        <li>Desain ergonomis dengan bahan premium</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection
