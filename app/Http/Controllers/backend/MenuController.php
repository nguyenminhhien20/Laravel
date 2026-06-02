<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Menu::select('id', 'name', 'link', 'type', 'position', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('backend.menu.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { {
            $parentMenus = Menu::select('id', 'name')
                ->where('status', 1)
                ->orderBy('name', 'asc')
                ->get();

            return view('backend.menu.create', compact('parentMenus'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $menu = new Menu();
        $menu->name        = $request->name;
        $menu->link        = $request->link;
        $menu->table_id    = $request->table_id;
        $menu->parent_id   = $request->parent_id ?? 0;
        $menu->sort_order  = $request->sort_order ?? 1;
        $menu->type        = $request->type;
        $menu->position    = $request->position;
        $menu->status      = $request->status;
        $menu->created_by = auth()->check() ? auth()->id() : 1;
        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Thêm menu thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::findOrFail($id);

        // Trả về view với dữ liệu menu
        return view('backend.menu.show', compact('menu'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Tìm menu theo ID, nếu không tìm thấy sẽ báo lỗi 404.
        $menu = Menu::findOrFail($id);

        // Lấy danh sách menu cha (ngoại trừ menu đang được chỉnh sửa)
        $parentMenus = Menu::select('id', 'name')
            ->where('status', 1)
            ->where('id', '<>', $id)
            ->orderBy('name', 'asc')
            ->get();

        return view('backend.menu.edit', compact('menu', 'parentMenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMenuRequest $request, $id)
    {
        // Tìm menu cần cập nhật
        $menu = Menu::findOrFail($id);

        // Cập nhật các trường
        $menu->name        = $request->name;
        $menu->link        = $request->link;
        $menu->table_id    = $request->table_id;
        $menu->parent_id   = $request->parent_id ?? 0;
        $menu->sort_order  = $request->sort_order ?? 1;
        $menu->type        = $request->type;
        $menu->position    = $request->position;
        $menu->status      = $request->status;
        $menu->updated_by  = auth()->check() ? auth()->id() : 1; // Cập nhật người sửa
        $menu->save();

        // Trả về trang danh sách menu với thông báo thành công
        return redirect()->route('menu.index')->with('success', 'Cập nhật menu thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return redirect()->route('menu.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        $menu->delete(); // Soft delete

        return redirect()->route('menu.index')->with('success', 'Sản phẩm đã được chuyển vào thùng rác.');
    }




    public function trash()
    { {
            $list = Menu::onlyTrashed('id', 'name', 'link', 'type', 'position', 'status')
                ->orderBy('created_at', 'desc')
                ->paginate(5);

            return view('backend.menu.trash', compact('list'));
        }
    }

    public function delete($id)
    {
        $menu = Menu::withTrashed()->find($id);

        if (!$menu) {
            return redirect()->route('menu.trash')->with('error', 'Sản phẩm không tồn tại trong thùng rác.');
        }

        // Xóa ảnh nếu có
        $image_path = public_path('assets/images/menu/' . $menu->thumbnail);
        if (\File::exists($image_path)) {
            \File::delete($image_path);
        }

        // Xóa vĩnh viễn
        $menu->forceDelete();

        return redirect()->route('menu.trash')->with('success', 'Đã xóa vĩnh viễn sản phẩm.');
    }


    public function restore(string $id)
    {
        $menu = Menu::withTrashed()->find($id);

        if ($menu == null) {
            return redirect()->route('menu.index')->with('error', 'Mẫu tin không tồn tại!');
        }

        $menu->restore();

        return redirect()->route('menu.trash')->with('success', 'Khôi phục thành công');
    }
}
