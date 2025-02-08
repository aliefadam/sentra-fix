<aside id="sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="#" class="flex items-center p-3 {{ active_sidebar('admin/dashboard') }} rounded-lg group">
                    <i class="fas fa-home w-5 transition duration-75"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-3 {{ active_sidebar('admin/product') }} rounded-lg group">
                    <i class="fas fa-box w-5 transition duration-75"></i>
                    <span class="ml-3">Produk</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-3 {{ active_sidebar('admin/transaction') }} rounded-lg group">
                    <i class="fas fa-shopping-cart w-5 transition duration-75"></i>
                    <span class="ml-3">Pesanan</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
