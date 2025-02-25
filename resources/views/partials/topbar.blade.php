<nav class="fixed top-0 z-20 w-full shadow-md bg-white border-b border-gray-200">
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
                    <span class="text-xl poppins-semibold">sentra<span class="poppins-bold text-red-600">fix </span>
                        - admin
                    </span>
                </div>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ml-3">
                    <div class="flex items-center">
                        <div class="mr-3 text-right">
                            <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                        </div>
                        <div class="relative">
                            <button type="button" data-dropdown-toggle="dropdown-user-popup"
                                class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300"
                                id="user-menu-button">
                                <img class="w-8 h-8 shadow-sm rounded-full"
                                    src="{{ auth()->user()->image ? '/uploads/users/' . auth()->user()->image : '/imgs/no-image.png' }}" />
                            </button>
                            <div id="dropdown-user-popup"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-md w-72 !-translate-x-[250px] !translate-y-[60px] dark:bg-gray-700 dark:divide-gray-600">
                                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white flex gap-3 items-center">
                                    <img src="{{ auth()->user()->image ? '/uploads/users/' . auth()->user()->image : '/imgs/no-image.png' }}"
                                        class="w-10 h-10 rounded-full" alt="">
                                    <div class="">
                                        <div>{{ auth()->user()->name }}</div>
                                        <div class="font-medium truncate">{{ auth()->user()->email }}</div>
                                    </div>
                                </div>
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdown-user">
                                    <li>
                                        <a href="{{ route('backend.change-password') }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            Ganti Password
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            Keluar
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
