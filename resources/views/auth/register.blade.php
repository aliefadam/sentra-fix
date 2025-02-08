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
                    <h2 class="text-2xl font-bold text-gray-900">Pendaftaran Akun</h2>
                    <p class="text-gray-600 mt-2">Silakan daftar untuk melanjutkan</p>
                </div>
                <form class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text"
                                class="!rounded-button block w-full pl-10 pr-3 py-2 border border-gray-300 focus:ring-custom focus:border-custom"
                                placeholder="Masukkan nama anda" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email"
                                class="!rounded-button block w-full pl-10 pr-3 py-2 border border-gray-300 focus:ring-custom focus:border-custom"
                                placeholder="Masukkan email anda" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password"
                                class="!rounded-button block w-full pl-10 pr-10 py-2 border border-gray-300 focus:ring-custom focus:border-custom"
                                placeholder="Masukkan kata sandi" />
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit"
                        class="!rounded-button w-full py-2.5 bg-gradient-to-r from-black to-pink-500 text-white font-medium hover:bg-custom/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom">
                        Daftar
                    </button>
                    <p class="text-center text-sm text-gray-600 mt-8">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-medium text-custom hover:text-custom/80">Silahkan
                            Login</a>
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
                const input = document.querySelector('input[type="password"]');
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
