<header class="sticky top-0 z-50 bg-white shadow-md">
    <nav class="max-w-8xl mx-auto px-4 py-1 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex-shrink-0 flex items-center gap-2">
                <img class="h-8 drop-shadow-md scale-125" src="{{ asset('imgs/logo-sentra-fix-removebg-preview.png') }}"
                    alt="TokoKita" />
                <h1 class="text-lg poppins-medium">sentra<span class="text-pink-500 poppins-semibold">fix</span></h1>
            </div>
            <div class="hidden sm:block flex-1 max-w-2xl mx-8">
                <form class="flex items-center max-w-full mx-auto">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" id="simple-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500"
                            placeholder="Cari produk..." required />
                    </div>
                </form>
            </div>
            <div class="flex items-center space-x-6">
                @auth
                    <a href="#" class="text-gray-700 hover:text-custom">
                        <i class="fas fa-shopping-cart text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-custom">
                        <i class="fas fa-user text-xl"></i>
                    </a>
                @else
                    <button type="button"
                        class="text-white bg-pink-700 hover:bg-pink-800 focus:outline-none focus:ring-4 focus:ring-pink-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-pink-600 dark:hover:bg-pink-700 dark:focus:ring-pink-800">
                        <i class="fa fa-user text-sm mr-1"></i>
                        Masuk
                    </button>

                @endauth
            </div>
        </div>
    </nav>
</header>
