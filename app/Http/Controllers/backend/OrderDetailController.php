<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Product;

class OrderDetailController extends Controller
{
    // Danh sách chi tiết đơn hàng
    public function index()
    {
        $list = OrderDetail::select(
                'order_detail.id',
                'order_detail.order_id',
                'order_detail.product_id',
                'product.name as product_name',
                'order_detail.price_buy',
                'order_detail.qty',
                'order_detail.amount',
                'product.name as product_name'
            )
            ->join('product', 'order_detail.product_id', '=', 'product.id')
            ->orderBy('order_detail.id', 'desc')
            ->paginate(10);

        return view('backend.order-detail.index', compact('list'));
    }

    // Chuyển vào thùng rác
    public function delete($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->delete();

        return redirect()->route('order-detail.index')->with('success', 'Đã chuyển vào thùng rác!');
    }

    // Hiển thị thùng rác
    public function trash()
    {
        $list = OrderDetail::onlyTrashed()
            ->join('product', 'order_detail.product_id', '=', 'product.id')
            ->select(
                'order_detail.id',
                'order_detail.order_id',
                'order_detail.product_id',
                'order_detail.price_buy',
                'order_detail.qty',
                'order_detail.amount',
                'product.name as product_name'
            )
            ->orderBy('order_detail.id', 'desc')
            ->paginate(10);

        return view('backend.order-detail.trash', compact('list'));
    }

    // Khôi phục từ thùng rác
    public function restore($id)
    {
        $orderDetail = OrderDetail::withTrashed()->findOrFail($id);
        $orderDetail->restore();

        return redirect()->route('order-detail.trash')->with('success', 'Khôi phục thành công!');
    }

    // Xóa vĩnh viễn
    public function destroy($id)
    {
        $orderDetail = OrderDetail::onlyTrashed()->findOrFail($id);
        $orderDetail->forceDelete();

        return redirect()->route('order-detail.trash')->with('success', 'Đã xóa vĩnh viễn!');
    }
}
