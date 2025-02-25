@extends('layouts.user')

@section('content')
    <main class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="min-h-[70vh] flex items-center justify-center px-4 py-8">
            <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8 text-center">
                <div class="w-20 h-20 mx-auto mb-6 flex items-center justify-center rounded-full bg-green-100 shadow-md">
                    <i class="fas fa-check-circle text-4xl text-green-500"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-4">
                    Pendaftaran Berhasil!
                </h1>
                <p class="text-gray-600 mb-6">
                    Mohon untuk menunggu agar admin dapat memproses verifikasi data Anda
                    dalam waktu 1-2 hari kerja. Terima kasih atas kesabaran Anda.
                </p>
                <p class="text-gray-600 italic mb-8">
                    <i class="far fa-envelope mr-2"></i>
                    Silakan cek email Anda secara berkala untuk informasi selanjutnya
                </p>
                <a href="{{ route('home') }}"
                    class="!rounded-button bg-red-700 text-white px-6 py-3 font-medium hover:bg-red-800 transition-colors rounded-md">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </main>
@endsection
