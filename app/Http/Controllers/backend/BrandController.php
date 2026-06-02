<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Brand::select('id', 'name', 'slug', 'image', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('backend.brand.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->sort_order = $request->sort_order ?? 0;
        $brand->description = $request->description ?? '';
        $brand->status = $request->status ?? 1;
        $brand->created_by = Auth::id() ?? 1;
        $brand->updated_by = Auth::id() ?? 1;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/brand'), $filename);
            $brand->image = $filename;
        }

        $brand->save();

        return redirect()->route('brand.index')->with('success', 'Thêm thương hiệu thành công!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::withTrashed()->findOrFail($id);
        return view('backend.brand.show', compact('brand'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::withTrashed()->findOrFail($id);

        if ($brand->trashed()) {
            return redirect()->route('brand.trash')->with('error', 'Thương hiệu này đang ở trong thùng rác.');
        }

        return view('backend.brand.edit', compact('brand'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, string $id)
    {
        $brand = Brand::findOrFail($id);

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->sort_order = $request->sort_order ?? 0;
        $brand->description = $request->description ?? '';
        $brand->status = $request->status ?? 1;
        $brand->updated_by = Auth::id() ?? 1;

        // Xử lý ảnh mới nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($brand->image && File::exists(public_path('assets/images/brand/' . $brand->image))) {
                File::delete(public_path('assets/images/brand/' . $brand->image));
            }

            $file = $request->file('image');
            $filename = Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/brand'), $filename);
            $brand->image = $filename;
        }

        $brand->save();

        return redirect()->route('brand.index')->with('success', 'Cập nhật thương hiệu thành công!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return redirect()->route('brand.index')->with('error', 'Thương hiệu không tồn tại.');
        }

        if ($brand->products()->count() > 0) {
            return redirect()->route('brand.index')->with('error', 'Không thể xóa vì thương hiệu đang có sản phẩm.');
        }

        $brand->delete(); // Soft delete

        return redirect()->route('brand.index')->with('success', 'Thương hiệu đã được chuyển vào thùng rác.');
    }


    public function trash()
    {
        $list = Brand::onlyTrashed('id', 'name', 'slug', 'image', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('backend.brand.trash', compact('list'));
    }

    public function delete($id)
    {
        $brand = Brand::withTrashed()->find($id);

        if (!$brand) {
            return redirect()->route('brand.trash')->with('error', 'Thương hiệu không tồn tại trong thùng rác.');
        }

        if ($brand->products()->count() > 0) {
            return redirect()->route('brand.trash')->with('error', 'Không thể xóa vì thương hiệu đang có sản phẩm.');
        }

        // Xóa ảnh nếu có
        $image_path = public_path('assets/images/brand/' . $brand->image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        // Xóa vĩnh viễn
        $brand->forceDelete();

        return redirect()->route('brand.trash')->with('success', 'Đã xóa vĩnh viễn thương hiệu.');
    }



    public function restore(string $id)
    {
        $brand = Brand::withTrashed()->find($id);

        if ($brand == null) {
            return redirect()->route('brand.index')->with('error', 'Mẫu tin không tồn tại!');
        }

        $brand->restore();

        return redirect()->route('brand.trash')->with('success', 'Khôi phục thành công');
    }
}
