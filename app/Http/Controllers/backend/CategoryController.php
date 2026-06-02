<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Category::select('id', 'name', 'slug', 'image', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.category.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $slug = Str::of($request->name)->slug('-');

        // Kiểm tra slug duy nhất
        if (Category::where('slug', $slug)->exists()) {
            return redirect()->back()->with('error', 'Slug đã tồn tại, vui lòng chọn một slug khác');
        }

        $category->name = $request->name;
        $category->slug = $request->slug ?? $slug;

        // Xử lý hình ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->move(public_path('assets/images/category'), $fileName);
            $category->image = $fileName;
        }

        $category->parent_id   = $request->input('parent_id', 0);
        $category->sort_order  = $request->input('sort_order', 0);
        $category->description = $request->description ?? '';
        $category->status      = $request->status;

        $category->created_by = Auth::id() ?? 0;
        $category->updated_by = Auth::id() ?? 0;

        $category->save();

        return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $slug = Str::of($request->name)->slug('-');

        // Kiểm tra slug duy nhất khi update
        if (Category::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            return redirect()->back()->with('error', 'Slug đã tồn tại, vui lòng chọn một slug khác');
        }

        $category->name = $request->name;
        $category->slug = $request->slug ?? $slug;

        // Xử lý hình ảnh mới nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($category->image && File::exists(public_path('assets/images/category/' . $category->image))) {
                File::delete(public_path('assets/images/category/' . $category->image));
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->move(public_path('assets/images/category'), $fileName);
            $category->image = $fileName;
        }

        // Cập nhật các trường khác
        $category->parent_id   = $request->input('parent_id', 0);
        $category->sort_order  = $request->input('sort_order', 0);
        $category->description = $request->description ?? '';
        $category->status      = $request->status;

        // Cập nhật thông tin người dùng
        $category->updated_by = Auth::id() ?? 0;

        $category->save();

        return redirect()->route('category.index')->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Danh mục không tồn tại.');
        }

        if ($category->products()->count() > 0) {
            return redirect()->route('category.index')->with('error', 'Không thể xóa vì danh mục đang chứa sản phẩm.');
        }

        $category->delete(); // Soft delete

        return redirect()->route('category.index')->with('success', 'Danh mục đã được chuyển vào thùng rác.');
    }

    public function trash()
    {
        $list = Category::onlyTrashed()
            ->select('id', 'name', 'slug', 'image', 'status')
            ->orderBy('deleted_at', 'desc')
            ->paginate(5);
        return view('backend.category.trash', compact('list'));
    }

    public function delete($id)
    {
        $category = Category::withTrashed()->find($id);

        if (!$category) {
            return redirect()->route('category.trash')->with('error', 'Danh mục không tồn tại trong thùng rác.');
        }

        if ($category->products()->count() > 0) {
            return redirect()->route('category.trash')->with('error', 'Không thể xóa vì danh mục đang chứa sản phẩm.');
        }

        // Xóa ảnh nếu có
        $image_path = public_path('assets/images/category/' . $category->image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $category->forceDelete();

        return redirect()->route('category.trash')->with('success', 'Đã xóa vĩnh viễn danh mục.');
    }


    public function restore(string $id)
    {
        $category = Category::withTrashed()->find($id);

        if ($category == null) {
            return redirect()->route('category.index')->with('error', 'Mẫu tin không tồn tại!');
        }

        $category->restore();

        return redirect()->route('category.trash')->with('success', 'Khôi phục thành công');
    }
}
