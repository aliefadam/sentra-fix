<header class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center justify-between h-16">
            <div class="flex-shrink-0 flex items-center gap-1.5">
                <a href="/" class="flex items-center">
                    <img class="h-8 w-auto drop-shadow-md" src="{{ asset('imgs/logo-sentra-fix-removebg-preview.png') }}"
                        alt="Logo" />
                </a>
                <span class="text-xl poppins-semibold">sentra<span class="poppins-bold text-pink-600">fix</span></span>
            </div>

            <div class="hidden md:flex items-center justify-center flex-1 space-x-8">
                <a href="{{ route('home') }}" class="font-medium {{ active_navbar('/') }}">Beranda</a>
                <a href="{{ route('products') }}" class="font-medium {{ active_navbar('products') }}">Produk</a>
                <a href="{{ route('categories') }}" class="font-medium {{ active_navbar('categories') }}">Kategori</a>
                {{-- <a href="#" class="font-medium">Transaksi</a> --}}
                <a href="{{ route('about') }}" class="font-medium {{ active_navbar('about') }}">Tentang Kami</a>
            </div>
            <div class="flex items-center space-x-6 relative">
                <button class="text-gray-700 hover:text-custom"
                    onclick="document.getElementById(&#39;search-popup&#39;).classList.remove(&#39;hidden&#39;)">
                    <i class="fas fa-search text-xl"></i>
                </button>
                <div id="search-popup" class="hidden fixed top-20 left-0 right-0 px-4">
                    <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md mx-auto">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Pencarian</h3>
                            <button
                                onclick="document.getElementById(&#34;search-popup&#34;).classList.add(&#34;hidden&#34;)"
                                class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <input type="search" placeholder="Cari produk..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-custom focus:border-transparent" />
                    </div>
                </div>
                <button class="text-gray-700 hover:text-custom"
                    onclick="document.getElementById(&#39;user-popup&#39;).classList.remove(&#39;hidden&#39;)">
                    <i class="fas fa-user text-xl"></i>
                </button>
                <div id="user-popup" class="hidden absolute top-16 right-0 mt-2 w-80">
                    <div class="bg-white p-6 rounded-lg shadow-xl w-full">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Profil Pengguna</h3>
                            <button
                                onclick="document.getElementById(&#34;user-popup&#34;).classList.add(&#34;hidden&#34;)"
                                class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('imgs/logo-user.png') }}" class="w-16 h-16 rounded-full" />
                                <div>
                                    <p class="font-semibold">John Doe</p>
                                    <p class="text-gray-500">john.doe@example.com</p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <button
                                    class="w-full text-sm bg-white border-2 border-black text-black py-2.5 px-4 rounded-md hover:bg-opacity-90">
                                    Edit Profil
                                </button>
                                <button
                                    class="w-full text-sm bg-custom text-white py-2.5 px-4 rounded-md hover:bg-opacity-90">
                                    Daftar Transaksi
                                </button>
                                <button
                                    class="w-full text-sm bg-red-700 text-white py-2.5 px-4 rounded-md hover:bg-opacity-90">
                                    Keluar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="text-gray-700 hover:text-custom relative"
                    onclick="document.getElementById(&#39;cart-popup&#39;).classList.remove(&#39;hidden&#39;)">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span
                        class="absolute -top-2 -right-2 bg-pink-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </button>
                <div id="cart-popup" class="hidden absolute top-16 right-0 mt-2 w-80">
                    <div class="bg-white p-6 rounded-lg shadow-xl w-full">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Keranjang Belanja</h3>
                            <button
                                onclick="document.getElementById(&#34;cart-popup&#34;).classList.add(&#34;hidden&#34;)"
                                class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="space-y-4 mb-4">
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('imgs/p-1.png') }}" class="w-16 h-16 object-cover shadow-md" />
                                <div class="flex-1">
                                    <p class="font-semibold">Produk 1</p>
                                    <p class="text-gray-500">Rp 199.000</p>
                                </div>
                                <p class="text-gray-700">x1</p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('imgs/p-2.png') }}" class="w-16 h-16 object-cover shadow-md" />
                                <div class="flex-1">
                                    <p class="font-semibold">Produk 2</p>
                                    <p class="text-gray-500">Rp 299.000</p>
                                </div>
                                <p class="text-gray-700">x1</p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('imgs/p-3.png') }}" class="w-16 h-16 object-cover shadow-md" />
                                <div class="flex-1">
                                    <p class="font-semibold">Produk 3</p>
                                    <p class="text-gray-500">Rp 399.000</p>
                                </div>
                                <p class="text-gray-700">x1</p>
                            </div>
                        </div>
                        <button class="w-full bg-custom text-white py-2 px-4 rounded-md hover:bg-opacity-90">
                            Lihat Semua
                        </button>
                    </div>
                </div>
                <button class="md:hidden text-gray-700 hover:text-custom" id="mobile-menu-button">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </nav>
        <div class="hidden md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium {{ active_navbar('/') }} hover:bg-gray-50">Beranda</a>
                <a href="{{ route('products') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium {{ active_navbar('products') }} hover:bg-gray-50">Produk</a>
                <a href="{{ route('categories') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium {{ active_navbar('categories') }} hover:bg-gray-50">Kategori</a>
                {{-- <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium {{ active_navbar("/") }} hover:bg-gray-50">Transaksi</a> --}}
                <a href="{{ route('about') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium {{ active_navbar('about') }} hover:bg-gray-50">Tentang
                    Kami</a>
            </div>
        </div>
    </div>
</header>
<script>
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");
    mobileMenuButton.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
    });
</script>
