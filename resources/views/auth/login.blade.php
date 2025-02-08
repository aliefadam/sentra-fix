@extends('layouts.auth')

@section('content')
    <div class="flex h-screen">
        <div class="hidden lg:flex lg:w-1/2 relative">
            <img src="{{ asset('imgs/auth.png') }}" alt="E-commerce Banner" class="object-cover w-full h-full" />
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-pink-600/80 flex items-center justify-center">
                {{-- <div class="absolute inset-0 bg-gradient-to-t from-pink-600/70 to-pink-600/50 flex items-center justify-center"> --}}
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
                    <h2 class="text-2xl font-bold text-gray-900">Masuk ke Akun Anda</h2>
                    <p class="text-gray-600 mt-2">Silakan masuk untuk melanjutkan</p>
                </div>
                <form class="space-y-6" method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fas fa-envelope text-gray-500"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full ps-10 p-3  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500"
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
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full ps-10 p-3  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500"
                                placeholder="Masukkan password anda">
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember"
                                class="!rounded h-4 w-4 text-custom accent-pink-600 focus:ring-pink-600 text-pink-600 border-gray-300" />
                            <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
                        </div>
                        <a href="#" class="text-sm font-medium text-custom hover:text-custom/80">Lupa kata
                            sandi?</a>
                    </div>
                    <button type="submit"
                        class="cursor-pointer text-white bg-pink-700 hover:bg-pink-800 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full dark:bg-pink-600 dark:hover:bg-pink-700 focus:outline-none dark:focus:ring-pink-800">Masuk</button>
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-gray-50 text-gray-500">atau lanjutkan dengan</span>
                        </div>
                    </div>
                    <button type="submit"
                        class="cursor-pointer text-black bg-white border border-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full flex justify-center items-center ">
                        <img src="https://www.google.com/favicon.ico" alt="Google" class="w-5 h-5 mr-2" />
                        Masuk dengan Google
                    </button>
                    <p class="text-center text-sm text-gray-600 mt-8">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="font-medium text-pink-600 hover:text-pink-700">Daftar
                            sekarang</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document
            .querySelector('button[type="button"]')
            .addEventListener("click", function() {
                const input = document.querySelector('input[id="password"]');
                const icon = this.querySelector("i");
                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            });
    </script>
@endsection
