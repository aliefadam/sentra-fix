@extends('layouts.user')

@section('content')
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
                    class="!rounded-button bg-gradient-to-r from-custom to-pink-500 text-white px-4 py-2 text-sm font-medium hover:bg-custom/90">
                    <i class="fas fa-key mr-2"></i>
                    Ganti Password
                </a>
            </div>
            <div class="bg-white shadow rounded-lg p-8">
                <form class="space-y-8">
                    <div class="space-y-6">
                        <div class="flex items-center space-x-6">
                            <div class="h-24 w-24 rounded-full overflow-hidden bg-gray-100">
                                <img class="h-full w-full object-cover" src="{{ asset('imgs/logo-user.png') }}"
                                    alt="Foto profil" />
                            </div>
                            <button type="button"
                                class="!rounded-button bg-custom text-white px-4 py-2 text-sm font-medium hover:bg-custom/90">
                                Ganti Foto
                            </button>
                        </div>
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-custom focus:border-custom sm:text-sm"
                                    value="John Doe" />
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-custom focus:border-custom sm:text-sm"
                                    value="john.doe@example.com" />
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                <input type="tel" name="phone" id="phone"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-custom focus:border-custom sm:text-sm"
                                    value="081234567890" />
                            </div>
                            <div>
                                <label for="birth" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input type="date" name="birth" id="birth"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-custom focus:border-custom sm:text-sm"
                                    value="1990-01-01" />
                            </div>
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <select id="gender" name="gender"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-custom focus:border-custom sm:text-sm">
                                    <option value="male">Laki-laki</option>
                                    <option value="female">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="bg-white shadow rounded-lg p-8">
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
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button"
                    class="!rounded-button px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit"
                    class="!rounded-button bg-custom text-white px-4 py-2 text-sm font-medium hover:bg-custom/90">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </main>

    {{-- Add Address Modal --}}
    <div id="add-address-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">
                    Tambah Alamat Baru
                </h3>
                <form class="space-y-4">
                    <input type="text" placeholder="Label Alamat (contoh: Rumah, Kantor)"
                        class="w-full p-2 border border-gray-300 rounded-lg" /><input type="text"
                        placeholder="Nama Penerima" class="w-full p-2 border border-gray-300 rounded-lg" /><input
                        type="tel" placeholder="Nomor Telepon"
                        class="w-full p-2 border border-gray-300 rounded-lg" />
                    <textarea placeholder="Alamat Lengkap" class="w-full p-2 border border-gray-300 rounded-lg h-24"></textarea><input type="text" placeholder="Kode Pos"
                        class="w-full p-2 border border-gray-300 rounded-lg" />
                    <div class="flex justify-end space-x-3 mt-4">
                        <button type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300"
                            onclick="hideAddAddressModal()">
                            Batal</button><button type="submit"
                            class="px-4 py-2 bg-custom text-white rounded-lg hover:bg-custom/90">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Address Modal --}}
    <div id="edit-address-modal"
        class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Alamat</h3>
                <form class="space-y-4">
                    <input type="text" placeholder="Label Alamat" class="w-full p-2 border border-gray-300 rounded-lg"
                        value="Rumah" /><input type="text" placeholder="Nama Penerima"
                        class="w-full p-2 border border-gray-300 rounded-lg" value="Budi Santoso" /><input type="tel"
                        placeholder="Nomor Telepon" class="w-full p-2 border border-gray-300 rounded-lg"
                        value="081234567890" />
                    <textarea placeholder="Alamat Lengkap" class="w-full p-2 border border-gray-300 rounded-lg h-24">
    Jl. Sudirman No. 123, RT 001/RW 002</textarea><input type="text" placeholder="Kode Pos"
                        class="w-full p-2 border border-gray-300 rounded-lg" value="10310" />
                    <div class="flex justify-end space-x-3 mt-4">
                        <button type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300"
                            onclick="hideEditAddressModal()">
                            Batal</button><button type="submit"
                            class="px-4 py-2 bg-custom text-white rounded-lg hover:bg-custom/90">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function showAddAddressModal() {
            document.getElementById("add-address-modal").classList.remove("hidden");
        }

        function hideAddAddressModal() {
            document.getElementById("add-address-modal").classList.add("hidden");
        }

        function showEditAddressModal() {
            document
                .getElementById("edit-address-modal")
                .classList.remove("hidden");
        }

        function hideEditAddressModal() {
            document.getElementById("edit-address-modal").classList.add("hidden");
        }
    </script>
@endsection
