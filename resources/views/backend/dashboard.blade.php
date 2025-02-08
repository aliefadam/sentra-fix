@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex items-center">
                <div class="inline-flex flex-shrink-0 justify-center items-center w-12 h-12 text-white bg-custom rounded-lg">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="flex-grow ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Pesanan</p>
                    <h3 class="text-xl font-bold">1,257</h3>
                </div>
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex items-center">
                <div
                    class="inline-flex flex-shrink-0 justify-center items-center w-12 h-12 text-white bg-green-500 rounded-lg">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="flex-grow ml-4">
                    <p class="text-sm font-medium text-gray-600">Pendapatan</p>
                    <h3 class="text-xl font-bold">Rp 45,257,000</h3>
                </div>
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex items-center">
                <div
                    class="inline-flex flex-shrink-0 justify-center items-center w-12 h-12 text-white bg-yellow-500 rounded-lg">
                    <i class="fas fa-users"></i>
                </div>
                <div class="flex-grow ml-4">
                    <p class="text-sm font-medium text-gray-600">Pelanggan</p>
                    <h3 class="text-xl font-bold">854</h3>
                </div>
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow">
            <div class="flex items-center">
                <div
                    class="inline-flex flex-shrink-0 justify-center items-center w-12 h-12 text-white bg-red-500 rounded-lg">
                    <i class="fas fa-box"></i>
                </div>
                <div class="flex-grow ml-4">
                    <p class="text-sm font-medium text-gray-600">Jumlah Produk</p>
                    <h3 class="text-xl font-bold">128</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
        <div class="p-4 bg-white rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-4">Penjualan Tahun 2024</h4>
            <div id="yearlyChart" style="width: 100%; height: 300px"></div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-4">Penjualan per Kategori</h4>
            <div id="categoryChart" style="width: 100%; height: 300px"></div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="p-4 bg-white rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-4">Produk Terlaris</h4>
            <div class="overflow-y-auto max-h-[380px]">
                <div class="space-y-4">
                    <div class="flex items-center p-3 border rounded-lg">
                        <img class="w-16 h-16 rounded object-cover"
                            src="https://creatie.ai/ai/api/search-image?query=A professional product photo of a delicious chocolate donut with sprinkles on a clean white background, showcasing the texture and toppings in detail&width=64&height=64&orientation=squarish&flag=e3da4fe1-6539-46bc-9dc9-f89e0438fc7b&flag=a7783d0d-c60f-41b6-8f99-021ce5634190"
                            alt="Produk" />
                        <div class="ml-4">
                            <h5 class="font-semibold">Donat Coklat</h5>
                            <p class="text-sm text-gray-600">Terjual: 234 pcs</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 border rounded-lg">
                        <img class="w-16 h-16 rounded object-cover"
                            src="https://creatie.ai/ai/api/search-image?query=A professional product photo of a strawberry glazed donut on a clean white background, showing the pink frosting and texture details&width=64&height=64&orientation=squarish&flag=44c29a25-12f7-48c5-9ade-3e4b8976f81c&flag=b9d3b1ef-c6e2-4d26-bc4d-4296b61916e4"
                            alt="Produk" />
                        <div class="ml-4">
                            <h5 class="font-semibold">Donat Stroberi</h5>
                            <p class="text-sm text-gray-600">Terjual: 189 pcs</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 border rounded-lg">
                        <img class="w-16 h-16 rounded object-cover"
                            src="https://creatie.ai/ai/api/search-image?query=A professional product photo of a vanilla glazed donut with rainbow sprinkles on a clean white background, highlighting the colorful toppings&width=64&height=64&orientation=squarish&flag=9a591127-7254-43e4-9833-9ea13c2bf0f8&flag=88acd449-8c64-4d86-aa6d-781afd153657"
                            alt="Produk" />
                        <div class="ml-4">
                            <h5 class="font-semibold">Donat Vanilla</h5>
                            <p class="text-sm text-gray-600">Terjual: 156 pcs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-4">Penjualan Terbaru</h4>
            <div class="overflow-y-auto max-h-[380px]">
                <div class="space-y-4">
                    <div class="p-3 border rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <h5 class="font-semibold">#ORD-2024-1257</h5>
                            <span class="text-sm text-gray-600">2 jam yang lalu</span>
                        </div>
                        <p class="text-sm text-gray-600">Budi Santoso</p>
                        <p class="text-sm font-medium">Rp 125,000</p>
                    </div>
                    <div class="p-3 border rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <h5 class="font-semibold">#ORD-2024-1256</h5>
                            <span class="text-sm text-gray-600">4 jam yang lalu</span>
                        </div>
                        <p class="text-sm text-gray-600">Siti Rahayu</p>
                        <p class="text-sm font-medium">Rp 87,000</p>
                    </div>
                    <div class="p-3 border rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <h5 class="font-semibold">#ORD-2024-1255</h5>
                            <span class="text-sm text-gray-600">5 jam yang lalu</span>
                        </div>
                        <p class="text-sm text-gray-600">Ahmad Wijaya</p>
                        <p class="text-sm font-medium">Rp 156,000</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-4">Status Pengiriman</h4>
            <div class="space-y-4">
                <div class="p-4 border rounded-lg flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-box text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium">Dalam Proses</p>
                            <p class="text-sm text-gray-600">Pesanan sedang dikemas</p>
                        </div>
                    </div>
                    <span class="text-xl font-bold">24</span>
                </div>
                <div class="p-4 border rounded-lg flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-truck text-yellow-600"></i>
                        </div>
                        <div>
                            <p class="font-medium">Dikirim</p>
                            <p class="text-sm text-gray-600">Pesanan dalam pengiriman</p>
                        </div>
                    </div>
                    <span class="text-xl font-bold">18</span>
                </div>
                <div class="p-4 border rounded-lg flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <div>
                            <p class="font-medium">Selesai</p>
                            <p class="text-sm text-gray-600">Pesanan telah diterima</p>
                        </div>
                    </div>
                    <span class="text-xl font-bold">156</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document
            .getElementById("toggleSidebarMobile")
            .addEventListener("click", function() {
                document
                    .getElementById("sidebar")
                    .classList.toggle("-translate-x-full");
            });
        const yearlyChart = echarts.init(document.getElementById("yearlyChart"));
        const yearlyOption = {
            animation: false,
            tooltip: {
                trigger: "axis",
            },
            xAxis: {
                type: "category",
                data: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "Mei",
                    "Jun",
                    "Jul",
                    "Agu",
                    "Sep",
                    "Okt",
                    "Nov",
                    "Des",
                ],
            },
            yAxis: {
                type: "value",
            },
            series: [{
                data: [
                    820, 932, 901, 934, 1290, 1330, 1320, 1450, 1400, 1380, 1520,
                    1600,
                ],
                type: "line",
                smooth: true,
                lineStyle: {
                    color: "#4F46E5",
                },
                areaStyle: {
                    color: {
                        type: "linear",
                        x: 0,
                        y: 0,
                        x2: 0,
                        y2: 1,
                        colorStops: [{
                                offset: 0,
                                color: "rgba(79, 70, 229, 0.3)",
                            },
                            {
                                offset: 1,
                                color: "rgba(79, 70, 229, 0)",
                            },
                        ],
                    },
                },
            }, ],
        };
        yearlyChart.setOption(yearlyOption);
        const categoryChart = echarts.init(
            document.getElementById("categoryChart")
        );
        const categoryOption = {
            animation: false,
            tooltip: {
                trigger: "item",
            },
            legend: {
                // top: "1%",
                left: "center",
            },
            series: [{
                type: "pie",
                radius: ["20%", "60%"],
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 5,
                    borderColor: "#fff",
                    borderWidth: 2,
                },
                label: {
                    show: false,
                    position: "center",
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: "14",
                        fontWeight: "bold",
                    },
                },
                labelLine: {
                    show: false,
                },
                data: [{
                        value: 1048,
                        name: "Donat Coklat"
                    },
                    {
                        value: 735,
                        name: "Donat Vanilla"
                    },
                    {
                        value: 580,
                        name: "Donat Stroberi"
                    },
                    {
                        value: 484,
                        name: "Donat Matcha"
                    },
                    {
                        value: 300,
                        name: "Donat Original"
                    },
                ],
            }, ],
        };
        categoryChart.setOption(categoryOption);
        window.addEventListener("resize", function() {
            yearlyChart.resize();
            categoryChart.resize();
        });
        document
            .getElementById("user-menu-button")
            .addEventListener("click", function() {
                document.getElementById("user-menu").classList.toggle("hidden");
            });
    </script>
@endsection
