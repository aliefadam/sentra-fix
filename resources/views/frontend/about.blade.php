@extends('layouts.user')

@section('content')
    <div class="relative bg-custom">
        <div class="absolute inset-0"><img class="w-full h-full object-cover" src="{{ asset('imgs/about.png') }}"
                alt="Banner" />
            <div class="absolute inset-0 bg-black/50 mix-blend-multiply"></div>
        </div>
        <div class="relative max-w-8xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Selamat Datang di
                Sentrafix</h1>
            <p class="mt-6 text-xl text-gray-100 max-w-3xl">Solusi Terpercaya untuk memenuhi kebutuhan anda</p>
        </div>
    </div>
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">Sentra Fix adalah toko online yang menyediakan berbagai
                barang bekas berkualitas dengan harga terjangkau. Kami menghadirkan koleksi beragam, mulai dari pakaian,
                elektronik, perabotan rumah tangga, buku, hingga aksesori fashion. Semua barang yang kami jual telah melalui
                proses seleksi untuk memastikan kondisi yang masih layak pakai dan bernilai bagi pembeli.</p>
        </div>
        <div class="mt-20">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 mx-auto max-w-7xl">
                <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-custom text-white">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Terjamin Kualitasnya</h3>
                    <p class="mt-4 text-base text-gray-500">
                        Setiap produk melalui proses quality control yang ketat untuk memastikan kualitas terbaik
                        sebelum sampai ke tangan Anda.
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-custom text-white">
                        <i class="fas fa-tags text-xl"></i>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Harga Terbaik</h3>
                    <p class="mt-4 text-base text-gray-500">
                        Kami menawarkan harga yang kompetitif dan transparan, sehingga Anda mendapatkan nilai terbaik
                        untuk setiap pembelian.
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-md bg-custom text-white">
                        <i class="fas fa-shipping-fast text-xl"></i>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Pengiriman Aman</h3>
                    <p class="mt-4 text-base text-gray-500">
                        Sistem pengiriman yang aman dan terpercaya dengan asuransi untuk melindungi barang Anda selama
                        perjalanan.
                    </p>
                </div>
            </div>
        </div>
        <div class="mt-20 bg-white rounded-lg shadow-sm p-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Pencapaian Kami</h2>
            </div>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-3">
                <div class="text-center">
                    <p class="text-4xl font-bold text-pink-600">50,000+</p>
                    <p class="mt-2 text-lg text-black">Pelanggan Puas</p>
                </div>
                <div class="text-center">
                    <p class="text-4xl font-bold text-pink-600">100,000+</p>
                    <p class="mt-2 text-lg text-black">Transaksi Sukses</p>
                </div>
                <div class="text-center">
                    <p class="text-4xl font-bold text-pink-600">4.8/5</p>
                    <p class="mt-2 text-lg text-black">Rating Kepuasan</p>
                </div>
            </div>
        </div>
        <div class="mt-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Tim Kami</h2>
            </div>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 mx-auto max-w-7xl">
                <div class="text-center">
                    <img class="mx-auto h-40 w-40 rounded-full object-cover" src="{{ asset('imgs/about-1.png') }}"
                        alt="Team member" />
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Budi Santoso</h3>
                    <p class="text-custom">CEO &amp; Founder</p>
                </div>
                <div class="text-center">
                    <img class="mx-auto h-40 w-40 rounded-full object-cover" src="{{ asset('imgs/about-2.png') }}"
                        alt="Team member" />
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Siti Rahayu</h3>
                    <p class="text-custom">Operations Manager</p>
                </div>
                <div class="text-center">
                    <img class="mx-auto h-40 w-40 rounded-full object-cover" src="{{ asset('imgs/about-3.png') }}"
                        alt="Team member" />
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Ahmad Wijaya</h3>
                    <p class="text-custom">Quality Control Manager</p>
                </div>
            </div>
        </div>
        <div class="mt-20 text-center">
            <a href="{{ route('products') }}"
                class="!rounded-button inline-flex items-center px-8 py-3 border border-transparent text-base font-medium text-white bg-gradient-to-r from-black to-pink-500 hover:bg-custom/90">Belanja
                Sekarang <i class="fas fa-arrow-right ml-2"></i></a>
        </div>
    </div>
@endsection
