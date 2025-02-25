<header class="fixed top-0 left-0 right-0 z-20 bg-white shadow-md">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center justify-between h-16">
            <div class="flex-shrink-0 flex items-center gap-1.5">
                <a href="/" class="flex items-center">
                    <img class="h-8 scale-[120%] w-auto drop-shadow-md"
                        src="{{ asset('imgs/sentra-fix-logo - Copy.png') }}" alt="Logo" />
                    {{-- <img class="h-8 w-auto drop-shadow-md" src="{{ asset('imgs/logo-sentra-fix-removebg-preview.png') }}"
                        alt="Logo" /> --}}
                </a>
                {{-- <span class="text-xl poppins-semibold">sentra<span class="poppins-bold text-red-600">fix</span></span> --}}
            </div>

            <div class="hidden md:flex items-center justify-center flex-1 space-x-8">
                <a href="{{ route('home') }}" class="font-medium {{ active_navbar('/') }}">Beranda</a>
                <a href="{{ route('products') }}" class="font-medium {{ active_navbar('products') }}">Produk</a>
                <a href="{{ route('categories') }}" class="font-medium {{ active_navbar('categories') }}">Kategori</a>
                {{-- <a href="#" class="font-medium">Transaksi</a> --}}
                <a href="{{ route('about') }}" class="font-medium {{ active_navbar('about') }}">Tentang Kami</a>
            </div>
            <div class="mr-5">
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
                        <form action="{{ route('search') }}">
                            <div class="flex items-center gap-3">
                                <input type="text" placeholder="Cari produk..." name="q"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-custom focus:border-transparent" />
                                <button type="button"
                                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @auth
                <div class="flex items-center space-x-6 relative">
                    <button id="dropdown-user" data-dropdown-toggle="dropdown-user-popup"
                        class="text-gray-700 hover:text-custom" onclick="">
                        <i class="fas fa-user text-xl"></i>
                    </button>
                    <div id="dropdown-user-popup"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-md w-72 !-translate-x-[170px] !translate-y-[60px] dark:bg-gray-700 dark:divide-gray-600">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white flex gap-3 items-center">
                            <img src="{{ auth()->user()->image ? '/uploads/users/' . auth()->user()->image : '/imgs/no-image.png' }}"
                                class="w-10 h-10 rounded-full" alt="">
                            <div class="">
                                <div>{{ auth()->user()->name }}</div>
                                <div class="font-medium truncate">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-user">
                            <li>
                                <a href="{{ route('profile') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit
                                    Profil</a>
                            </li>
                            <li>
                                <a href="{{ route('transaction') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Daftar
                                    Transaksi</a>
                            </li>
                        </ul>
                        <div class="py-2">
                            <a href="{{ route('logout') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                Keluar
                            </a>
                        </div>
                    </div>
                    {{-- END User Popup --}}

                    <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
                        class="text-gray-700 hover:text-custom relative" onclick="">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span
                            class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center"
                            id="cart-count">{{ getCartCount() }}</span>
                    </button>

                    {{-- Cart Popup --}}
                    <!-- Dropdown menu -->
                    <div id="dropdownNotification"
                        class="!-translate-x-[270px] !translate-y-[60px] z-20 hidden w-[500px] max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow-md dark:bg-gray-800 dark:divide-gray-700"
                        aria-labelledby="dropdownNotificationButton">
                        <div
                            class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-white dark:bg-gray-800 dark:text-white">
                            Keranjang Belanja
                        </div>
                        <div class="divide-y divide-gray-100 dark:divide-gray-700" id="container-cart">
                            @foreach (getCarts() as $cart)
                                <a href="{{ route('product', ['slug' => $cart->product->slug]) }}"
                                    class="flex justify-between items-center p-4 hover:bg-gray-50">
                                    <div class="flex items-center gap-3">
                                        <img src="/uploads/products/{{ getProduct($cart->product_id, $cart->variant1_id, $cart->variant2_id)->image }}"
                                            class="w-12 h-12 rounded-md shadow-md object-cover" alt="">
                                        <div class="flex flex-col">
                                            <span>{{ Str::limit($cart->product->name, 20, '...') }}</span>
                                            <span class="text-sm text-gray-700">
                                                {{ getVariantLabel($cart->product, $cart->variant1_id, $cart->variant2_id) }}
                                                x
                                                {{ $cart->qty }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="poppins-semibold text-gray-700">{{ format_rupiah(getProductPrice($cart->product_id, $cart->variant1_id, $cart->variant2_id) * $cart->qty, true) }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <a href="{{ route('cart') }}"
                            class="block py-3 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                            <div class="inline-flex items-center ">
                                <i class="fa-regular fa-cart-shopping mr-2"></i>
                                Lihat semua keranjang
                            </div>
                        </a>
                    </div>
                    {{-- End Cart Popup --}}

                    <button class="md:hidden text-gray-700 hover:text-custom" id="mobile-menu-button">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Masuk</a>
            @endauth
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
