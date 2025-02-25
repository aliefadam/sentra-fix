@extends('layouts.auth')

@section('content')
    <div class="flex h-screen">
        <div class="hidden lg:flex lg:w-1/2 relative">
            <img src="{{ asset('imgs/auth.png') }}" alt="E-commerce Banner" class="object-cover w-full h-full" />
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-red-600/80 flex items-center justify-center">
                {{-- <div class="absolute inset-0 bg-gradient-to-t from-red-600/70 to-red-600/50 flex items-center justify-center"> --}}
                <div class="text-center text-white px-8">
                    <h1 class="text-4xl font-bold mb-4">Selamat Datang di SentraFix</h1>
                    <p class="text-lg">
                        Temukan berbagai produk bekas berkualitas dengan harga terjangkau
                    </p>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <div class="text-center mb-8">
                    <img src="{{ asset('imgs/logo-sentra-fix-removebg-preview.png') }}" alt="SentraFix Logo"
                        class="h-12 mx-auto mb-6" />
                    <h2 class="text-2xl font-bold text-gray-900">Pendaftaran Akun</h2>
                    <p class="text-gray-600 mt-2">Silakan daftar untuk melanjutkan</p>
                </div>
                <form class="space-y-6" method="POST" action="{{ route('register.post') }}">
                    @csrf
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Lengkap</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fas fa-user text-gray-500"></i>
                            </div>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full ps-10 p-3  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                placeholder="Masukkan nama anda">
                        </div>
                    </div>
                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fas fa-envelope text-gray-500"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full ps-10 p-3  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                placeholder="Masukkan email anda">
                        </div>
                    </div>
                    <div>
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fas fa-lock text-gray-500"></i>
                            </div>
                            <input type="password" id="password" name="password"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full ps-10 p-3  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                placeholder="Masukkan password anda">
                            <button type="button" id="btn-show-password"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label for="password_confirmation"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fas fa-lock text-gray-500"></i>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full ps-10 p-3  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                                placeholder="Masukkan password anda">
                            <button type="button" id="btn-show-password-confirmation"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="cursor-pointer text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                        Mendaftar
                    </button>

                    <p class="text-center text-sm text-gray-600 mt-8">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-medium text-red-600 hover:text-red-700">
                            Login
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#btn-show-password').click(function() {
            const input = $('input[name="password"]');
            const icon = $(this).find('i');
            if (input.attr('type') === "password") {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
        $('#btn-show-password-confirmation').click(function() {
            const input = $('input[name="password_confirmation"]');
            const icon = $(this).find('i');
            if (input.attr('type') === "password") {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    </script>
@endsection
