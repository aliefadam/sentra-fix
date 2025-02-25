@extends('layouts.auth')

@section('content')
    <main class="w-full h-screen flex justify-center items-center bg-gray-100">
        <div class="lg:w-[40%] w-[85%] bg-white rounded-lg lg:p-10 p-5 shadow-xl">
            <h1 class="text-3xl poppins-bold text-red-800 text-center">SENTRAFIX</h1>
            <p class="mt-3 text-center text-gray-900">
                Silahkan melakukan reset password anda, halaman ini akan kadaluarsa dalam 60 Menit
            </p>
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ request()->email }}">
                <div class="my-5">
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-red-800 dark:text-white">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <i class="fa-solid fa-lock text-red-800"></i>
                        </div>
                        <input type="password" id="password" name="password" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-red-800 focus:border-red-800 block w-full ps-10 p-2.5"
                            placeholder="********">
                        <div class="absolute inset-y-0 end-3 flex items-center">
                            <i id="btn-show" class="fa-solid fa-eye text-red-800 cursor-pointer"></i>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="password_confirmation"
                        class="block mb-2 text-sm font-medium text-red-800 dark:text-white">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <i class="fa-solid fa-lock text-red-800"></i>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-red-800 focus:border-red-800 block w-full ps-10 p-2.5"
                            placeholder="********">
                        <div class="absolute inset-y-0 end-3 flex items-center">
                            <i id="btn-show-confirmation" class="fa-solid fa-eye text-red-800 cursor-pointer"></i>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <button type="submit"
                        class="text-white bg-red-800 hover:bg-red-900 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 w-full">
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
@section('more-script')
    <script>
        $(document).ready(function() {
            $("#btn-show").click(function() {
                if ($(this).hasClass("fa-eye")) {
                    $(this).removeClass("fa-eye").addClass("fa-eye-slash");
                    $("#password").attr("type", "text")
                } else {
                    $(this).removeClass("fa-eye-slash").addClass("fa-eye");
                    $("#password").attr("type", "password")
                }
            })

            $("#btn-show-confirmation").click(function() {
                if ($(this).hasClass("fa-eye")) {
                    $(this).removeClass("fa-eye").addClass("fa-eye-slash");
                    $("#password_confirmation").attr("type", "text")
                } else {
                    $(this).removeClass("fa-eye-slash").addClass("fa-eye");
                    $("#password_confirmation").attr("type", "password")
                }
            })
        });
    </script>
@endsection
