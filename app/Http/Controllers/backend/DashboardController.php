<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1️⃣ Thống kê tổng quan
        $today = Carbon::today();
        $newUsers = User::whereDate('created_at', $today)->count();
        $ordersToday = Order::whereDate('created_at', $today)->count();
        $productsSold = OrderDetail::sum('qty');
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');

        // 2️⃣ Top 5 sản phẩm bán chạy
        $topProducts = Product::withSum(['orderDetails as total_sold' => function ($q) {
            $q->whereHas('order', function ($q2) {
                $q2->where('status', 'completed');
            });
        }], 'qty')
        ->orderByDesc('total_sold')
        ->take(5)
        ->get();

        // 3️⃣ Biểu đồ doanh thu & đơn hàng 6 tháng gần nhất
        $revenueData = [];
        $orderCountData = [];
        $monthLabels = [];

        for ($i = 5; $i >= 0; $i--) { // 6 tháng gần nhất
            $month = Carbon::now()->subMonths($i);
            $monthLabels[] = $month->format('M Y');

            $revenue = Order::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->where('status', 'completed')
                ->sum('total_amount') / 1_000_000; // triệu ₫
            $revenueData[] = round($revenue, 2);

            $orderCount = Order::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();
            $orderCountData[] = $orderCount;
        }

        return view('backend.dashboard.index', compact(
            'newUsers',
            'ordersToday',
            'productsSold',
            'totalRevenue',
            'topProducts',
            'revenueData',
            'orderCountData',
            'monthLabels'
        ));
    }
}
