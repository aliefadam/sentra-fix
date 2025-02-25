@extends('layouts.auth')

@section('content')
    <main class="w-full h-screen flex justify-center items-center bg-gray-100">
        <div class="lg:w-[40%] w-[85%] bg-white rounded-lg lg:p-10 p-5 shadow-xl">
            <h1 class="text-3xl poppins-bold text-red-800 text-center">SENTRAFIX</h1>
            <p class="mt-3 text-center text-gray-900">Silahkan tuliskan email anda, agar kami bisa mengirimkan link untuk
                mereset password anda
            </p>
            <form action="{{ route('forgot-password-post') }}" method="POST">
                @csrf
                <div class="my-5">
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <i class="fa-solid fa-envelope text-red-800"></i>
                        </div>
                        <input type="email" id="email" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-red-800 focus:border-red-800 block w-full ps-10 p-2.5"
                            required>
                    </div>
                </div>

                <div class="mb-5">
                    <button type="submit"
                        class="text-white bg-red-800 hover:bg-red-900 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 w-full">
                        <i class="fa-solid fa-paper-plane mr-1"></i> Kirim
                    </button>
                </div>

                <span class="text-center block text-sm">Belum punya akun? <a href="/register"
                        class="text-red-800 poppins-semibold">Daftar</a></span>
            </form>
        </div>
    </main>
@endsection
