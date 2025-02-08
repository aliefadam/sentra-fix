<nav class="fixed top-0 z-50 w-full shadow-md bg-white border-b border-gray-200">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
                    class="p-2 text-gray-600 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100">
                    <i class="fas fa-bars w-6 h-6"></i>
                </button>
                <div class="flex-shrink-0 flex items-center gap-1.5">
                    <a href="/" class="flex items-center">
                        <img class="h-8 w-auto drop-shadow-md"
                            src="{{ asset('imgs/logo-sentra-fix-removebg-preview.png') }}" alt="Logo" />
                    </a>
                    <span class="text-xl poppins-semibold">sentra<span class="poppins-bold text-pink-600">fix </span>
                        - admin
                    </span>
                </div>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ml-3">
                    <div class="flex items-center">
                        <div class="mr-3 text-right">
                            <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">Admin</p>
                        </div>
                        <div class="relative">
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300"
                                id="user-menu-button">
                                <img class="w-8 h-8 rounded-full"
                                    src="https://creatie.ai/ai/api/search-image?query=A professional headshot of a young Indonesian businessman wearing a modern suit, captured against a clean white background. The image should show confidence and approachability, with natural lighting highlighting facial features&width=32&height=32&orientation=squarish&flag=44ec8676-91d1-4cc2-8f26-824c212627ec&flag=9fdb235e-1fe6-4a69-af1e-dbc5fb4d3b70"
                                    alt="user photo" />
                            </button>
                            <div class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50"
                                id="user-menu">
                                <div class="px-4 py-3">
                                    <p class="text-sm font-medium">John Doe</p>
                                    <p class="text-sm text-gray-600 truncate">
                                        john@example.com
                                    </p>
                                </div>
                                <hr class="border-gray-200" />
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ganti
                                    Password</a><a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
