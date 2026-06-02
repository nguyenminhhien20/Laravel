<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    public function index()
    {
        $list = Order::select('order.*')
            ->join('user', 'order.user_id', '=', 'user.id')
            ->orderBy('order.created_at', 'desc')
            ->paginate(5);

        return view('backend.order.index', compact('list'));
    }

    public function create()
    {
        $list_user = User::where('status', 1)->get();
        return view('backend.order.create', compact('list_user'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = new Order();

        $order->fill($request->only([
            'name',
            'phone',
            'email',
            'address',
            'address_detail',
            'note',
            'status',
            'user_id'
        ]));
        $order->created_by = auth()->id() ?? 0;

        $order->save();

        return redirect()->route('order.index')->with('success', 'Thêm đơn hàng thành công');
    }

    public function show(string $id)
    {
        $order = Order::withTrashed()->findOrFail($id);
        return view('backend.order.show', compact('order'));
    }

    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        $list_user = User::where('status', 1)->get();

        return view('backend.order.edit', compact('order', 'list_user'));
    }

    public function update(UpdateOrderRequest $request, string $id)
    {
        $order = Order::findOrFail($id);

        $order->fill($request->only([
            'name',
            'phone',
            'email',
            'address',
            'address_detail',
            'note',
            'status',
            'user_id'
        ]));

        $order->updated_by = auth()->id() ?? 0;

        $order->save();

        return redirect()->route('order.index')->with('success', 'Cập nhật đơn hàng thành công');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete(); // Soft delete

        return redirect()->route('order.index')->with('success', 'Đã chuyển đơn hàng vào thùng rác.');
    }

    public function trash()
    {
        $list = Order::onlyTrashed()
            ->join('user', 'order.user_id', '=', 'user.id')
            ->select('order.*')
            ->orderBy('order.created_at', 'desc')
            ->paginate(5);

        return view('backend.order.trash', compact('list'));
    }

    public function restore($id)
    {
        $order = Order::withTrashed()->find($id);

        if (!$order) {
            return redirect()->route('order.index')->with('error', 'Đơn hàng không tồn tại!');
        }

        $order->restore();

        return redirect()->route('order.trash')->with('success', 'Khôi phục đơn hàng thành công!');
    }

    public function delete($id)
    {
        $order = Order::withTrashed()->find($id);

        if (!$order) {
            return redirect()->route('order.trash')->with('error', 'Đơn hàng không tồn tại!');
        }

        // Xóa orderDetails nếu có
        if (method_exists($order->orderDetails(), 'forceDelete')) {
            $order->orderDetails()->forceDelete();
        } else {
            $order->orderDetails()->delete();
        }

        // Xóa ảnh nếu có
        if ($order->thumbnail) {
            $image_path = public_path('assets/images/order/' . $order->thumbnail);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        $order->forceDelete();

        return redirect()->route('order.trash')->with('success', 'Đã xóa vĩnh viễn đơn hàng.');
    }

    public function status($id)
    {
        $order = Order::findOrFail($id);

        // Chuyển đổi trạng thái đơn hàng theo thứ tự
        switch ($order->status) {
            case 'pending':
                $order->status = 'processing';
                break;
            case 'processing':
                $order->status = 'shipped';
                break;
            case 'shipped':
                $order->status = 'completed';
                break;
            case 'completed':
                $order->status = 'completed'; // Giữ nguyên hoặc cho quay vòng
                break;
            case 'cancelled':
                $order->status = 'pending'; // Hoặc giữ nguyên nếu không muốn khôi phục đơn đã hủy
                break;
            default:
                $order->status = 'pending';
                break;
        }

        $order->save();

        return redirect()->route('order.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
