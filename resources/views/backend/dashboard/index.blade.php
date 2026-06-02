<x-layout-admin>
    <div class="p-6 space-y-10">
        <!-- Header -->
        <div class="flex items-center justify-between bg-gradient-to-r from-indigo-600 to-rose-500 text-white px-8 py-6 rounded-xl shadow-md">
            <div>
                <h1 class="text-3xl font-bold tracking-wide">📊 Thống Kê Tổng Quan</h1>
                <p class="text-sm opacity-90 mt-1">Cập nhật số liệu mới nhất về hoạt động kinh doanh</p>
            </div>
            <div class="flex gap-4">
                <a href="#" class="bg-white text-indigo-700 px-5 py-2 rounded-lg font-semibold shadow hover:bg-indigo-100">
                    <i class="fas fa-plus mr-2"></i> Thêm Dữ Liệu
                </a>
                <a href="#" class="bg-white text-red-600 px-5 py-2 rounded-lg font-semibold shadow hover:bg-red-100">
                    <i class="fas fa-trash-alt mr-2"></i> Thùng Rác
                </a>
            </div>
        </div>

        <!-- Cards Overview -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl p-5 shadow-md border border-gray-100">
                <p class="text-sm text-gray-500">Người dùng mới hôm nay</p>
                <p class="text-3xl font-bold text-blue-600 mt-1">{{ $newUsers }}</p>
            </div>
            <div class="bg-white rounded-xl p-5 shadow-md border border-gray-100">
                <p class="text-sm text-gray-500">Đơn hàng hôm nay</p>
                <p class="text-3xl font-bold text-rose-500 mt-1">{{ $ordersToday }}</p>
            </div>
            <div class="bg-white rounded-xl p-5 shadow-md border border-gray-100">
                <p class="text-sm text-gray-500">Sản phẩm đã bán</p>
                <p class="text-3xl font-bold text-green-600 mt-1">{{ $productsSold }}</p>
            </div>
            <div class="bg-white rounded-xl p-5 shadow-md border border-gray-100">
                <p class="text-sm text-gray-500">Tổng doanh thu</p>
                <p class="text-3xl font-bold text-yellow-500 mt-1">₫{{ number_format($totalRevenue,0,',','.') }}</p>
            </div>
        </div>

        <!-- Chart -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
            <h2 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
                <i class="fas fa-chart-line text-indigo-500"></i> Biểu đồ doanh thu & đơn hàng
            </h2>
            <canvas id="dashboardChart" height="130"></canvas>
        </div>

        <!-- Table of Top Products -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
            <h3 class="text-lg font-bold text-gray-700 mb-4">🔥 Top sản phẩm bán chạy</h3>
            <table class="w-full table-auto text-sm text-left text-gray-700">
                <thead class="bg-indigo-100 text-indigo-800">
                    <tr>
                        <th class="px-4 py-3">Sản phẩm</th>
                        <th class="px-4 py-3">Đã bán</th>
                        <th class="px-4 py-3">Giá</th>
                        <th class="px-4 py-3">Doanh thu</th>
                        <th class="px-4 py-3 text-right">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topProducts as $product)
                    @php
                        $soldQty = $product->total_sold ?? 0;
                        $revenue = $soldQty * $product->price_sale;
                    @endphp
                    <tr class="hover:bg-gray-50 transition-all">
                        <td class="px-4 py-3 border-t">{{ $product->name }}</td>
                        <td class="px-4 py-3 border-t">{{ $soldQty }}</td>
                        <td class="px-4 py-3 border-t">{{ number_format($product->price_sale,0,',','.') }}₫</td>
                        <td class="px-4 py-3 border-t text-green-600 font-semibold">{{ number_format($revenue,0,',','.') }}₫</td>
                        <td class="px-4 py-3 border-t text-right space-x-2">
                            <a href="{{ route('product.show', $product->id) }}" class="text-blue-600 hover:underline">Chi tiết</a>
                            <a href="javascript:void(0);" onclick="document.getElementById('delete-form-{{ $product->id }}').submit()" class="text-red-500 hover:underline">Xóa</a>

                            <form id="delete-form-{{ $product->id }}" action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-gray-500">Chưa có sản phẩm nào bán</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('dashboardChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($monthLabels),
                datasets: [
                    {
                        label: 'Doanh thu (triệu ₫)',
                        data: @json($revenueData),
                        backgroundColor: 'rgba(59,130,246,0.7)',
                        borderRadius: 6,
                        barThickness: 30
                    },
                    {
                        label: 'Đơn hàng',
                        data: @json($orderCountData),
                        backgroundColor: 'rgba(244,114,182,0.7)',
                        borderRadius: 6,
                        barThickness: 30
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { labels: { color: '#4B5563', font: { size: 14 } } },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { color: '#6B7280' }, grid: { color: '#E5E7EB' } },
                    x: { ticks: { color: '#6B7280' }, grid: { display: false } }
                }
            }
        });
    </script>
</x-layout-admin>
