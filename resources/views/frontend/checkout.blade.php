@extends('layouts.user')

@section('content')
    <main class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-4">Produk yang Dibeli</h2>
                    <div class="flex flex-col sm:flex-row items-center py-4 border-b">
                        <img src="{{ asset('imgs/p-2.png') }}" alt="Headphone"
                            class="w-20 h-20 object-cover rounded shadow-md" />
                        <div class="ml-0 sm:ml-4 flex-1 mt-4 sm:mt-0 text-center sm:text-left">
                            <h3 class="font-medium">Wireless Headphone Pro</h3>
                            <p class="text-sm text-gray-500">Warna: Hitam</p>
                            <div class="flex flex-col sm:flex-row justify-between mt-2 space-y-2 sm:space-y-0">
                                <p>1 x Rp 2.499.000</p>
                                <p class="font-medium">Rp 2.499.000</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Alamat Pengiriman</h2>
                        <button class="text-custom hover:text-custom-dark !rounded-button">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </button>
                    </div>
                    <div class="space-y-4">
                        <p class="font-medium">Ahmad Sudirman</p>
                        <p>+62 812-3456-7890</p>
                        <p>
                            Jl. Sudirman No. 123, RT 01/RW 02, Kelurahan Sudirman, Kecamatan
                            Sudirman
                        </p>
                        <p>Jakarta Pusat, DKI Jakarta 10110</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-4">Pilih Pengiriman</h2>
                    <div class="space-y-4">
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer">
                            <input type="radio" name="shipping" class="form-radio text-custom" checked="" />
                            <span class="ml-3">
                                <span class="font-medium">JNE Regular (2-3 hari)</span>
                                <span class="block text-sm text-gray-500">Rp 15.000</span>
                            </span>
                        </label>
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer">
                            <input type="radio" name="shipping" class="form-radio text-custom" />
                            <span class="ml-3">
                                <span class="font-medium">J&amp;T Express (1-2 hari)</span>
                                <span class="block text-sm text-gray-500">Rp 25.000</span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold mb-4">Metode Pembayaran</h2>
                    <div class="space-y-4">
                        <div class="mb-6">
                            <h3 class="text-md font-medium mb-3">Virtual Account</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 sm:gap-3">
                                <label
                                    class="border rounded-lg p-4 cursor-pointer hover:border-custom flex items-center"><input
                                        type="radio" name="payment" class="form-radio text-custom hidden"
                                        value="bca" />
                                    <div class="flex items-center">
                                        <img src="{{ asset('imgs/bca.png') }}" class="h-4 w-auto mr-3" /><span
                                            class="text-sm">BCA</span>
                                    </div>
                                </label><label
                                    class="border rounded-lg p-4 cursor-pointer hover:border-custom flex items-center"><input
                                        type="radio" name="payment" class="form-radio text-custom hidden"
                                        value="mandiri" />
                                    <div class="flex items-center">
                                        <img src="{{ asset('imgs/mandiri.png') }}" class="h-4 w-auto mr-3" /><span
                                            class="text-sm">Mandiri</span>
                                    </div>
                                </label><label
                                    class="border rounded-lg p-4 cursor-pointer hover:border-custom flex items-center"><input
                                        type="radio" name="payment" class="form-radio text-custom hidden"
                                        value="bri" />
                                    <div class="flex items-center">
                                        <img src="{{ asset('imgs/bri.png') }}" class="h-4 w-auto mr-3" /><span
                                            class="text-sm">BRI</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-md font-medium mb-3">E-Wallet</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 sm:gap-3">
                                <label
                                    class="border rounded-lg p-4 cursor-pointer hover:border-custom flex items-center"><input
                                        type="radio" name="payment" class="form-radio text-custom hidden"
                                        value="gopay" />
                                    <div class="flex items-center">
                                        <img src="{{ asset('imgs/qris.png') }}" class="h-4 w-auto mr-3" /><span
                                            class="text-sm">QRIS</span>
                                    </div>
                                </label><label
                                    class="border rounded-lg p-4 cursor-pointer hover:border-custom flex items-center"><input
                                        type="radio" name="payment" class="form-radio text-custom hidden"
                                        value="ovo" />
                                    <div class="flex items-center">
                                        <img src="{{ asset('imgs/ovo.png') }}" class="h-6 w-auto mr-3" /><span
                                            class="text-sm">OVO</span>
                                    </div>
                                </label><label
                                    class="border rounded-lg p-4 cursor-pointer hover:border-custom flex items-center"><input
                                        type="radio" name="payment" class="form-radio text-custom hidden"
                                        value="dana" />
                                    <div class="flex items-center">
                                        <img src="{{ asset('imgs/dana.png') }}" class="h-6 w-auto mr-3" /><span
                                            class="text-sm">DANA</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow p-4 sm:p-6 sticky top-6">
                    <h2 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h2>
                    <div class="space-y-3 pb-4 border-b">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal Produk</span>
                            <span>Rp 2.499.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Biaya Pengiriman</span>
                            <span>Rp 15.000</span>
                        </div>
                    </div>
                    <div class="flex justify-between py-4">
                        <span class="font-semibold">Total</span>
                        <span class="font-semibold">Rp 2.514.000</span>
                    </div>
                    <a href="{{ route('payment.waiting', ['invoice' => '123123123']) }}"
                        class="w-full block text-center bg-gradient-to-r from-black to-pink-500 text-white py-3 !rounded-button hover:bg-custom-dark">
                        Buat Pesanan
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
