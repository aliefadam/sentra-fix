@extends('layouts.user')

@section('content')
    <main>
        <div class="glide relative mb-8">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    <li class="glide__slide">
                        <div class="relative h-[250px] sm:h-[300px] md:h-[400px]">
                            <img src="{{ asset('imgs/caraousel.png') }}" class="w-full h-full object-cover"
                                alt="Promo Banner" />
                            <div class="absolute inset-0 bg-gradient-to-r from-custom/80 to-transparent flex items-center">
                                <div class="ml-4 sm:ml-8 md:ml-16 text-white">
                                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-2 sm:mb-4">Diskon
                                        Besar-Besaran</h2>
                                    <p class="text-base sm:text-lg md:text-xl mb-4 sm:mb-6">Hemat hingga 70% untuk semua
                                        produk</p>
                                    <button
                                        class="bg-white text-custom px-8 py-3 rounded-button font-semibold hover:bg-gray-100 focus:ring-4 focus:ring-white/50">Belanja
                                        Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="absolute bottom-4 left-0 right-0" data-glide-el="controls[nav]">
                <div class="flex justify-center space-x-2 bg-transparent">
                    <button class="w-2 h-2 bg-white rounded-full" data-glide-dir="=0"></button>
                    <button class="w-2 h-2 bg-white/50 rounded-full" data-glide-dir="=1"></button>
                    <button class="w-2 h-2 bg-white/50 rounded-full" data-glide-dir="=2"></button>
                </div>
            </div>
        </div>

        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <section class="mb-12">
                <h2 class="text-2xl font-semibold mb-8">Kategori Produk</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 sm:gap-6">
                    @foreach ($categories as $category)
                        <a href="#" class="group">
                            <div class="bg-white rounded-lg p-6 text-center shadow-sm hover:shadow-md transition-shadow">
                                <div
                                    class="w-16 h-16 mx-auto mb-4 bg-custom/10 rounded-full flex items-center justify-center">
                                    <i class="{{ $category->icon }} text-2xl text-custom"></i>
                                </div>
                                <h3 class="font-medium text-gray-900 group-hover:text-custom">{{ $category->name }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>

            <section class="mb-12">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-semibold">Produk Terbaru</h2>
                    <a href="{{ route('products') }}"
                        class="text-white bg-gradient-to-r from-pink-400 to-pink-700 hover:from-pink-500 hover:to-pink-800 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-pink-600 dark:hover:bg-pink-700 focus:outline-none dark:focus:ring-pink-800">
                        Lihat semua produk
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                    @foreach ($products as $product)
                        <a href="{{ route('product', ['slug' => $product->slug]) }}"
                            class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                            <img src="/uploads/products/{{ $product->productDetails[0]->image }}"
                                class="w-full h-48 object-cover rounded-t-lg" alt="Headphone" />
                            <div class="p-4">
                                <div class="flex items-center mb-2">
                                    <div class="text-yellow-400 flex">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    {{-- <span class="text-sm text-gray-500 ml-2">(95)</span> --}}
                                </div>
                                <h3 class="font-medium mb-2">{{ $product->name }}</h3>
                                <p class="text-custom font-semibold">{{ getLowerPriceProduct($product->id) }}</p>
                            </div>
                        </a>
                    @endforeach
                    {{-- <a href="{{ route('product', ['slug' => 'wireless-headphone-pro']) }}"
                        class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <img src="{{ asset('imgs/p-1.png') }}" class="w-full h-48 object-cover rounded-t-lg"
                            alt="Smartphone" />
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <div class="text-yellow-400 flex">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="text-sm text-gray-500 ml-2">(128)</span>
                            </div>
                            <h3 class="font-medium mb-2">Smartphone Pro Max</h3>
                            <p class="text-custom font-semibold">Rp 12.999.000</p>
                        </div>
                    </a>
                    <a href="{{ route('product', ['slug' => 'wireless-headphone-pro']) }}"
                        class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <img src="{{ asset('imgs/p-3.png') }}" class="w-full h-48 object-cover rounded-t-lg"
                            alt="Smartwatch" />
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <div class="text-yellow-400 flex">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-sm text-gray-500 ml-2">(76)</span>
                            </div>
                            <h3 class="font-medium mb-2">Smart Watch Series 5</h3>
                            <p class="text-custom font-semibold">Rp 3.999.000</p>
                        </div>
                    </a>
                    <a href="{{ route('product', ['slug' => 'wireless-headphone-pro']) }}"
                        class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <img src="{{ asset('imgs/p-4.png') }}" class="w-full h-48 object-cover rounded-t-lg"
                            alt="Tablet" />
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <div class="text-yellow-400 flex">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="text-sm text-gray-500 ml-2">(152)</span>
                            </div>
                            <h3 class="font-medium mb-2">Tablet Pro 2023</h3>
                            <p class="text-custom font-semibold">Rp 8.999.000</p>
                        </div>
                    </a> --}}
                </div>
            </section>

            <section class="mb-12 bg-gradient-to-r from-custom to-pink-500 rounded-lg">
                <div class="px-4 sm:px-8 py-8 sm:py-12 text-center text-white">
                    <h2 class="text-2xl sm:text-3xl font-bold mb-2 sm:mb-4">Promo Spesial!</h2>
                    <p class="text-base sm:text-xl mb-4 sm:mb-6">Dapatkan tambahan diskon 10% untuk pembelian pertama
                    </p>
                    <button
                        class="bg-white text-custom px-8 py-3 rounded-button font-semibold hover:bg-gray-100 focus:ring-4 focus:ring-white/50">Klaim
                        Sekarang</button>
                </div>
            </section>

            <section class="mb-12">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-semibold">Koleksi Produk</h2>
                    <a href="{{ route('products') }}"
                        class="text-white bg-gradient-to-r from-pink-400 to-pink-700 hover:from-pink-500 hover:to-pink-800 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-pink-600 dark:hover:bg-pink-700 focus:outline-none dark:focus:ring-pink-800">
                        Lihat semua produk
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                    @foreach ($products as $product)
                        <a href="{{ route('product', ['slug' => $product->slug]) }}"
                            class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                            <img src="/uploads/products/{{ $product->productDetails[0]->image }}"
                                class="w-full h-48 object-cover rounded-t-lg" alt="Headphone" />
                            <div class="p-4">
                                <div class="flex items-center mb-2">
                                    <div class="text-yellow-400 flex">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    {{-- <span class="text-sm text-gray-500 ml-2">(95)</span> --}}
                                </div>
                                <h3 class="font-medium mb-2">{{ $product->name }}</h3>
                                <p class="text-custom font-semibold">{{ getLowerPriceProduct($product->id) }}</p>
                            </div>
                        </a>
                    @endforeach
                    {{-- <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <img src="{{ asset('imgs/p-6.png') }}" class="w-full h-48 object-cover rounded-t-lg"
                            alt="Backpack" />
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <div class="text-yellow-400 flex">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-sm text-gray-500 ml-2">(167)</span>
                            </div>
                            <h3 class="font-medium mb-2">Travel Backpack</h3>
                            <p class="text-custom font-semibold">Rp 899.000</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <img src="{{ asset('imgs/p-7.png') }}" class="w-full h-48 object-cover rounded-t-lg"
                            alt="Speaker" />
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <div class="text-yellow-400 flex">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="text-sm text-gray-500 ml-2">(89)</span>
                            </div>
                            <h3 class="font-medium mb-2">Smart Speaker</h3>
                            <p class="text-custom font-semibold">Rp 1.999.000</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <img src="{{ asset('imgs/p-8.png') }}" class="w-full h-48 object-cover rounded-t-lg"
                            alt="Earbuds" />
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <div class="text-yellow-400 flex">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-sm text-gray-500 ml-2">(143)</span>
                            </div>
                            <h3 class="font-medium mb-2">Wireless Earbuds</h3>
                            <p class="text-custom font-semibold">Rp 1.499.000</p>
                        </div>
                    </div> --}}
                </div>
            </section>

            <section class="mb-12">
                <h1 class="mb-10 text-center poppins-semibold text-2xl">Mengapa harus Sentra Fix?</h1>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                        <i class="fas fa-shield-alt text-4xl mb-4 text-pink-600"></i>
                        <h3 class="font-semibold mb-2">Terjamin Kualitasnya</h3>
                        <p class="text-sm text-gray-600">Semua barang telah melalui proses pengecekan ketat</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                        <i class="fas fa-tags text-4xl mb-4 text-pink-600"></i>
                        <h3 class="font-semibold mb-2">Harga Terbaik</h3>
                        <p class="text-sm text-gray-600">Dapatkan barang berkualitas dengan harga terjangkau</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                        <i class="fas fa-truck text-4xl mb-4 text-pink-600"></i>
                        <h3 class="font-semibold mb-2">Pengiriman Aman</h3>
                        <p class="text-sm text-gray-600">Barang dikemas dengan aman dan dikirim tepat waktu</p>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.6.0/glide.min.js"></script>
    <script>
        new Glide('.glide', {
            type: 'carousel',
            startAt: 0,
            perView: 1,
            autoplay: 5000
        }).mount();
    </script>
@endsection
