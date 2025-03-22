@extends('layouts.user')

@section('content')
    <main class="max-w-8xl mx-auto px-4 sm:px-4 lg:px-8 py-4 sm:py-8">
        <div class="border bg-white rounded-md shadow-md p-5 flex justify-between">
            <div class="">
                <div class="flex items-center gap-4">
                    <img class="size-20 object-cover rounded-full shadow-sm" src="/uploads/stores/{{ $store->image }}"
                        alt="">
                    <div class="flex flex-col">
                        <span class="text-lg poppins-medium">
                            <i class="fa-regular fa-store"></i> {{ $store->name }}
                        </span>
                        <span>{{ json_decode($store->user->addresses()->first()->city)->name }}</span>
                    </div>
                </div>
            </div>
            <div class=" flex items-center gap-5">
                <div class="flex flex-col items-center">
                    <span class="text-xl text-red-700 poppins-semibold">{{ $store->user->products()->count() }}</span>
                    <span class="text-gray-700 poppins-medium">Jumlah Produk</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-xl text-red-700 poppins-semibold">{{ $store->transactionsDetails()->count() }}</span>
                    <span class="text-gray-700 poppins-medium">Pesanan Diproses</span>
                </div>
            </div>
        </div>

        <div class="mt-8 min-h-[80vh]">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl poppins-semibold text-gray-900">Produk Dijual</h1>
                {{-- @dump($store->user->email) --}}
                @if (auth()->user()->email == $store->user->email)
                    <a href="{{ route('seller.dashboard') }}"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Open Store Panel
                    </a>
                @endif
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-5">
                @foreach ($store->user->products as $product)
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
                            <h3 class="text-red-600 poppins-medium text-sm mt-1 mb-2">
                                <i class="fa-regular fa-store"></i> {{ $product->user->store->name }}
                            </h3>
                            <h3 class="font-medium text-lg">{{ $product->name }}</h3>
                            <p class="text-custom font-semibold text-gray-700">{{ getLowerPriceProduct($product->id) }}
                            </p>
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
        </div>
    </main>
@endsection
