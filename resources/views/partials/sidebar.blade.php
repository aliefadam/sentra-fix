<aside id="sidebar"
    class="fixed top-0 left-0 z-10 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto scrollbars bg-white">
        <ul class="font-medium">
            @foreach (getMenuSidebar() as $index => $menu)
                <li class="text-sm text-gray-500 mb-3 {{ $index > 0 ? 'mt-4' : '' }} capitalize">{{ $menu->name }}</li>
                @foreach ($menu->menuDetails as $detail)
                    <li class="mb-2">
                        @php
                            $route = explode('.', $detail->route)[1];
                        @endphp
                        <a href="{{ route($detail->route) }}"
                            class="flex items-center p-3 {{ active_sidebar("$menu->role/$route") }} rounded-lg group">
                            <i class="{{ $detail->icon }} w-5 transition duration-75"></i>
                            <span class="ml-3 capitalize">{{ $detail->name }}</span>
                        </a>
                    </li>
                @endforeach
            @endforeach
        </ul>
    </div>
</aside>
