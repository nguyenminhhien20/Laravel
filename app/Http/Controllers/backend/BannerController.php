<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Banner::select('id', 'name', 'image', 'position', 'link', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('backend.banner.index', compact('list'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request)
    {
        $banner = new Banner();
        $slug = Str::slug($request->name);

        // Gán các trường
        $banner->name = $request->name;
        $banner->link = $request->link;
        $banner->sort_order = $request->sort_order ?? 0;
        $banner->position = $request->position; // Đảm bảo cột này là string trong DB
        $banner->description = $request->description;
        $banner->status = $request->status;
        $banner->created_by = Auth::id() ?? 1;
        $banner->updated_by = Auth::id();

        // Xử lý ảnh upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '-' . time() . '.' . $extension;

            $uploadPath = public_path('assets/images/banner');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            $file->move($uploadPath, $fileName);
            $banner->image = $fileName;
        }

        // Lưu vào CSDL
        $banner->save();

        return redirect()->route('banner.index')->with('success', 'Thêm banner thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $banner = Banner::withTrashed()->findOrFail($id);
        return view('backend.banner.show', compact('banner'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::findOrFail($id);
        return view('backend.banner.edit', compact('banner'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, string $id)
    {
        $banner = Banner::findOrFail($id);
        $slug = Str::of($request->name)->slug('-');

        $banner->name = $request->name;
        $banner->link = $request->link;
        $banner->sort_order = $request->sort_order ?? 0;
        $banner->position = $request->position;
        $banner->description = $request->description;
        $banner->status = $request->status;
        $banner->updated_by = auth()->id();

        // Xử lý ảnh mới nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($banner->image && File::exists(public_path('assets/images/banner/' . $banner->image))) {
                File::delete(public_path('assets/images/banner/' . $banner->image));
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->move(public_path('assets/images/banner'), $fileName);
            $banner->image = $fileName;
        }

        $banner->save();

        return redirect()->route('banner.index')->with('success', 'Cập nhật banner thành công!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return redirect()->route('banner.index')->with('error', 'banner không tồn tại.');
        }

        $banner->delete(); // Soft delete

        return redirect()->route('banner.index')->with('success', 'banner đã được chuyển vào thùng rác.');
    }





    public function trash()
    {
        $list = Banner::onlyTrashed('id', 'name', 'image', 'position', 'link', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('backend.banner.trash', compact('list'));
    }

    public function delete($id)
    {
        $banner = Banner::withTrashed()->find($id);

        if (!$banner) {
            return redirect()->route('banner.trash')->with('error', 'Banner không tồn tại trong thùng rác.');
        }

        // Xóa ảnh nếu tồn tại
        if (!empty($banner->thumbnail)) {
            $image_path = public_path('assets/images/banner/' . $banner->thumbnail);
            if (\File::exists($image_path)) {
                \File::delete($image_path);
            }
        }

        // Xóa vĩnh viễn banner
        $banner->forceDelete();

        return redirect()->route('banner.trash')->with('success', 'Đã xóa vĩnh viễn banner.');
    }




    public function restore(string $id)
    {
        $banner = banner::withTrashed()->find($id);

        if ($banner == null) {
            return redirect()->route('banner.index')->with('error', 'Mẫu tin không tồn tại!');
        }

        $banner->restore();

        return redirect()->route('banner.trash')->with('success', 'Khôi phục thành công');
    }
}
