@extends('layouts.user')

@section('content')
    <main class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Kategori Produk</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
            <div class="bg-white rounded-lg shadow p-4 lg:p-6 hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-semibold mb-4 text-pink-600">
                    <i class="fas fa-mobile-alt mr-2"></i>
                    Elektronik
                </h2>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('category', ['slug' => 'smartphone']) }}"
                            class="text-black hover:scale-105 block duration-200">Smartphone</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Laptop &amp; Komputer</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Audio &amp; Speaker</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Aksesoris Elektronik</a>
                    </li>
                </ul>
            </div>
            <div class="bg-white rounded-lg shadow p-4 lg:p-6 hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-semibold text-pink-600 mb-4">
                    <i class="fas fa-tshirt mr-2"></i>
                    Fashion
                </h2>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Pakaian Pria</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Pakaian Wanita</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Sepatu</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Tas &amp; Aksesoris</a>
                    </li>
                </ul>
            </div>
            <div class="bg-white rounded-lg shadow p-4 lg:p-6 hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-semibold text-pink-600 mb-4">
                    <i class="fas fa-home mr-2"></i>
                    Rumah Tangga
                </h2>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Perabot Rumah</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Dapur</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Kamar Tidur</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Dekorasi</a>
                    </li>
                </ul>
            </div>
            <div class="bg-white rounded-lg shadow p-4 lg:p-6 hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-semibold text-pink-600 mb-4">
                    <i class="fas fa-heartbeat mr-2"></i>
                    Kesehatan
                </h2>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Suplemen</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Alat Kesehatan</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Perawatan Tubuh</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Masker &amp; Sanitizer</a>
                    </li>
                </ul>
            </div>
            <div class="bg-white rounded-lg shadow p-4 lg:p-6 hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-semibold text-pink-600 mb-4">
                    <i class="fas fa-gamepad mr-2"></i>
                    Gaming
                </h2>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Konsol Game</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Video Game</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Aksesoris Gaming</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Gaming Gear</a>
                    </li>
                </ul>
            </div>
            <div class="bg-white rounded-lg shadow p-4 lg:p-6 hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-semibold text-pink-600 mb-4">
                    <i class="fas fa-utensils mr-2"></i>
                    Makanan
                </h2>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Makanan Ringan</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Minuman</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Bahan Masak</a>
                    </li>
                    <li>
                        <a href="#" class="text-black hover:scale-105 block duration-200">Makanan Kemasan</a>
                    </li>
                </ul>
            </div>
        </div>
    </main>
@endsection
