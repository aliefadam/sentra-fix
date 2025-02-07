@extends('layouts.user')

@section('content')
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8 max-w-4xl">
        <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 md:p-8">
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-yellow-50 mb-4">
                    <i class="fas fa-clock text-2xl text-yellow-500"></i>
                </div>
                <h1 class="text-xl sm:text-2xl font-semibold">Menunggu Pembayaran</h1>
            </div>
            <div class="border rounded-lg p-4 sm:p-6 mb-4 sm:mb-6">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <p class="text-gray-600">Batas Akhir Pembayaran</p>
                        <p class="font-medium">Senin, 15 Jan 2024 15:30 WIB</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Sisa Waktu</p>
                        <p class="font-medium text-xl" id="countdown">23:59:59</p>
                    </div>
                </div>
            </div>
            <div class="border rounded-lg p-4 sm:p-6 mb-4 sm:mb-6">
                <h2 class="font-semibold mb-4">Transfer Bank BCA</h2>
                <div class="bg-gray-50 p-3 sm:p-4 rounded-lg mb-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600">Nomor Virtual Account</p>
                            <p class="font-mono text-base sm:text-lg font-medium">8277 0812 3456 7890</p>
                        </div>
                        <button class="!rounded-button bg-black text-white px-3 sm:px-4 py-2 text-sm whitespace-nowrap"
                            onclick="copyToClipboard(&#39;8277081234567890&#39;)">
                            <i class="far fa-copy mr-2"></i>Salin
                        </button>
                    </div>
                </div>
                <div class="border-t pt-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total Pembayaran</span>
                        <span class="text-xl font-semibold">Rp 2.514.000</span>
                    </div>
                </div>
            </div>
            <div class="space-y-3 sm:space-y-4">
                <a href=""
                    class="!rounded-button block text-center w-full bg-gradient-to-r from-black to-pink-500 text-white py-3 font-medium">
                    Lihat Daftar Transaksi
                </a>
                <a href="{{ route('home') }}"
                    class="!rounded-button w-full border block text-center border-gray-300 bg-white py-3 font-medium">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text);
        }

        function updateCountdown() {
            const now = new Date();
            const target = new Date(now.getTime() + 24 * 60 * 60 * 1000);

            function pad(n) {
                return n < 10 ? '0' + n : n;
            }
            setInterval(() => {
                const now = new Date();
                const diff = target - now;

                const hours = Math.floor(diff / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                document.getElementById('countdown').textContent =
                    `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
            }, 1000);
        }
        updateCountdown();
    </script>
@endsection
