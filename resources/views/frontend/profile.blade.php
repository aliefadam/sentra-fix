@extends('layouts.user')

@section('content')
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <main class="max-w-8xl mx-auto px-4 sm:px-4 lg:px-8 py-4 sm:py-8">
            <div class="space-y-8">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Edit Profil</h1>
                        <p class="mt-1 text-sm text-gray-600">
                            Perbarui informasi profil dan preferensi akun Anda.
                        </p>
                    </div>
                    <a href="{{ route('profile.change-password') }}"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        <i class="fas fa-key mr-2"></i>
                        Ganti Password
                    </a>
                </div>
                <div class="bg-white shadow rounded-lg p-8">
                    <form class="space-y-8">
                        <div class="space-y-6">
                            <div class="flex items-center space-x-6">
                                <div class="">
                                    <img id="image-preview" class="h-24 w-24 rounded-full shadow-md object-cover"
                                        src="{{ $user->image ? asset('uploads/users/' . $user->image) : asset('imgs/no-image.png') }}"
                                        alt="Foto profil" />
                                </div>
                                <button type="button" id="btn-change-image"
                                    class="!rounded-button bg-custom text-white px-4 py-2 text-sm font-medium hover:bg-custom/90">
                                    Ganti Foto
                                </button>
                                <input type="file" id="image" name="image" accept="image/*" class="hidden" />
                            </div>
                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                                <div class="">
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                        Lengkap</label>
                                    <input type="text" id="name" name="name" value="{{ $user->name }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                                        required />
                                </div>
                                <div class="">
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Email
                                    </label>
                                    <input type="text" id="email" name="email" value="{{ $user->email }}"
                                        class="bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 cursor-not-allowed"
                                        disabled required />
                                </div>
                                <div class="">
                                    <label for="phone"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        No. Telephone
                                    </label>
                                    <input type="number" id="phone" name="phone" value="{{ $user->phone }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                                        required />
                                </div>
                                <div class="">
                                    <label for="date_of_birth"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Tanggal Lahir
                                    </label>
                                    <input type="date" id="date_of_birth" name="date_of_birth"
                                        value="{{ $user->date_of_birth }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" />
                                </div>
                                <div>
                                    <label for="gender"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                                        Kelamin</label>
                                    <select id="gender" name="gender"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5">
                                        <option selected>-- Pilih --</option>
                                        <option @selected($user->gender == 'Laki-laki') value="Laki-laki">Laki-laki</option>
                                        <option @selected($user->gender == 'Perempuan') value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <div class="bg-white shadow rounded-lg p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-medium text-gray-900">Alamat Pengiriman</h2>
                    <button type="button"
                        class="!rounded-button bg-custom text-white px-4 py-2 text-sm font-medium hover:bg-custom/90"
                        onclick="showAddAddressModal()">
                        <i class="fas fa-plus mr-2"></i> Tambah Alamat
                    </button>
                </div>
                <div class="space-y-4">
                    <div class="border rounded-lg p-4 relative">
                        <div class="absolute top-4 right-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Alamat Utama
                            </span>
                        </div>
                        <div class="mt-2">
                            <h3 class="text-sm font-medium text-gray-900">Rumah</h3>
                            <p class="mt-1 text-sm text-gray-600">Budi Santoso</p>
                            <p class="mt-1 text-sm text-gray-600">081234567890</p>
                            <p class="mt-1 text-sm text-gray-600">
                                Jl. Sudirman No. 123, RT 001/RW 002
                            </p>
                            <p class="mt-1 text-sm text-gray-600">
                                Kelurahan Menteng, Kecamatan Menteng
                            </p>
                            <p class="mt-1 text-sm text-gray-600">
                                Jakarta Pusat, DKI Jakarta 10310
                            </p>
                        </div>
                        <div class="mt-4 flex space-x-3">
                            <button type="button" class="text-sm font-medium text-custom hover:text-custom/90"
                                onclick="showEditAddressModal()">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </button>
                            <button type="button" class="text-sm font-medium text-red-600 hover:text-red-500">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </div>
                    </div>
                    <div class="border rounded-lg p-4">
                        <div class="mt-2">
                            <h3 class="text-sm font-medium text-gray-900">Kantor</h3>
                            <p class="mt-1 text-sm text-gray-600">Budi Santoso</p>
                            <p class="mt-1 text-sm text-gray-600">081234567890</p>
                            <p class="mt-1 text-sm text-gray-600">
                                Jl. Gatot Subroto Kav. 56, Lantai 12
                            </p>
                            <p class="mt-1 text-sm text-gray-600">
                                Kelurahan Kuningan Timur, Kecamatan Setiabudi
                            </p>
                            <p class="mt-1 text-sm text-gray-600">
                                Jakarta Selatan, DKI Jakarta 12950
                            </p>
                        </div>
                        <div class="mt-4 flex space-x-3">
                            <button type="button" class="text-sm font-medium text-custom hover:text-custom/90"
                                onclick="showEditAddressModal()">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </button>
                            <button type="button" class="text-sm font-medium text-red-600 hover:text-red-500">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div> --}}
                <div class="flex justify-end space-x-4">
                    <a href=""
                        class="!rounded-button px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit"
                        class="!rounded-button bg-custom text-white px-4 py-2 text-sm font-medium hover:bg-custom/90">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </main>
    </form>
@endsection

@section('script')
    <script>
        $("#btn-change-image").click(showExplorer);
        $("#image").change(changeImage);

        function showExplorer() {
            $("#image").click();
        }

        function changeImage() {
            const image = URL.createObjectURL(this.files[0]);
            $("#image-preview").attr("src", image);
        }
    </script>
@endsection
