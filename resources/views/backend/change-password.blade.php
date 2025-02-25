@extends('layouts.admin')

@section('content')
    <div class="bg-white w-1/2 rounded-md shadow-md p-5">
        <form action="{{ route('backend.change-password-post') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label for="password_old" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Password Lama
                </label>
                <input type="password" id="password_old" name="password_old"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Password Baru
                </label>
                <input type="password" id="password" name="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Konfirmasi Password Baru
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5"
                    required />
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="text-white bg-pink-700 hover:bg-pink-800 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5">Ganti
                    Password</button>
            </div>
        </form>
    </div>
@endsection
