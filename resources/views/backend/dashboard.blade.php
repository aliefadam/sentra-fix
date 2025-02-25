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
                    <h3 class="text-xl font-bold">{{ $dashboard['transaction_count'] }}</h3>
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
                    <h3 class="text-xl font-bold">{{ format_rupiah($dashboard['income'], true) }}</h3>
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
                    <h3 class="text-xl font-bold">{{ $dashboard['buyer_count'] }}</h3>
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
                    <h3 class="text-xl font-bold">{{ $dashboard['product_count'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
        <div class="p-4 bg-white rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-4">Penjualan Tahun {{ date('Y') }}</h4>
            <div id="yearlyChart" style="width: 100%; height: 300px">
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-4">Penjualan per Kategori</h4>
            <div id="categoryChart" style="width: 100%; height: 300px"></div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="p-4 bg-white rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-4">Top 3 Produk Terlaris</h4>
            <div class="overflow-y-auto max-h-[380px]">
                <div class="space-y-4">
                    @foreach ($dashboard['top_3_best_selling_products'] as $product)
                        <div class="flex items-center p-3 border rounded-lg">
                            <img class="w-16 h-16 rounded object-cover" src="/uploads/products/{{ $product->image }}"
                                alt="Produk" />
                            <div class="ml-4">
                                <h5 class="font-semibold">{{ $product->name }}</h5>
                                <p class="text-sm text-gray-600">Terjual: {{ $product->total_sold }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-4">Penjualan Terbaru</h4>
            <div class="overflow-y-auto max-h-[380px]">
                <div class="space-y-4">
                    @foreach ($dashboard['latest_transactions'] as $transaction)
                        <div class="p-3 border rounded-lg">
                            <div class="flex justify-between items-center mb-2">
                                <h5 class="font-semibold text-sm">{{ $transaction->invoice }}</h5>
                                <span class="text-sm text-gray-600">{{ $transaction->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-600">{{ $transaction->user->name }}</p>
                            <p class="text-sm font-medium">{{ format_rupiah($transaction->total, true) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-4">Status Pengiriman</h4>
            <div class="space-y-4">
                <div class="p-4 border rounded-lg flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-truck text-yellow-600"></i>
                        </div>
                        <div>
                            <p class="font-medium">Menunggu Pembayaran</p>
                            <p class="text-sm text-gray-600">Pesanan belum dibayar</p>
                        </div>
                    </div>
                    <span class="text-xl font-bold">{{ $dashboard['waiting_status_count'] }}</span>
                </div>
                <div class="p-4 border rounded-lg flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-box text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium">Dalam Pengiriman</p>
                            <p class="text-sm text-gray-600">Pesanan dalam perjalanan</p>
                        </div>
                    </div>
                    <span class="text-xl font-bold">{{ $dashboard['delivery_status_count'] }}</span>
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
                    <span class="text-xl font-bold">{{ $dashboard['done_status_count'] }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const yearlyChart = echarts.init(document.getElementById("yearlyChart"));
        const dataYearlyChart = @json($dashboard['transaction_per_month']);

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
                data: dataYearlyChart.map((data) => data.total_transactions),
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

        const dataCategories = @json($dashboard['transaction_by_category']);
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
                data: dataCategories.map((data) => {
                    return {
                        name: data.name,
                        value: data.total_transactions,
                    }
                })
            }],
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
