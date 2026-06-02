<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $list = Product::select('product.id', 'product.name', 'product.qty', 'category.name as categoryname', 'brand.name as brandname', 'thumbnail', 'product.status')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->orderBy('product.created_at', 'desc')
            ->paginate(5);
        return view('backend.product.index', compact('list'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->orderBy('sort_order', 'asc')->get();
        $brands = Brand::select('id', 'name')->orderBy('sort_order', 'asc')->get();
        return view('backend.product.create', [
            'list_category' => $categories,
            'brands' => $brands
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $slug = Str::of($request->name)->slug('-');

        $product->name = $request->name;
        $product->slug = $slug;
        $product->detail = $request->detail;
        $product->price_root = $request->price_root;
        $product->price_sale = $request->price_sale;
        $product->qty = $request->qty;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->move(public_path('assets/images/product'), $fileName);
            $product->thumbnail = $fileName;
        }

        $product->status = $request->status;
        $product->created_by = Auth::id() ?? 1;
        $product->created_at = now();
        $product->save();

        return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Sản phẩm không tồn tại!');
        }
        return view('backend.product.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $list_category = Category::select('id', 'name')->orderBy('sort_order', 'asc')->get();
        $brands = Brand::select('id', 'name')->orderBy('sort_order', 'asc')->get();
        return view('backend.product.edit', compact('product', 'list_category', 'brands'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Sản phẩm không tồn tại!');
        }

        $slug = Str::of($request->name)->slug('-');

        $product->name = $request->name;
        $product->slug = $slug;
        $product->detail = $request->detail;
        $product->description = $request->description;
        $product->price_root = $request->price_root;
        $product->price_sale = $request->price_sale;
        $product->qty = $request->qty;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->status = $request->status;
        $product->updated_by = Auth::id() ?? 1;
        $product->updated_at = now();

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $image_path = public_path('assets/images/product/' . $product->thumbnail);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = $slug . '.' . $extension;
            $file->move(public_path('assets/images/product'), $filename);
            $product->thumbnail = $filename;
        }

        $product->save();
        return redirect()->route('product.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        $product->delete();
        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được chuyển vào thùng rác.');
    }


    public function trash()
    {
        $list = Product::select('product.id', 'product.name', 'category.name as categoryname', 'brand.name as brandname', 'thumbnail', 'product.status')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->onlyTrashed()
            ->orderBy('product.created_at', 'desc')
            ->paginate(5);

        return view('backend.product.trash', compact('list'));
    }

    public function delete($id)
    {
        $product = Product::withTrashed()->find($id);
        if (!$product) {
            return redirect()->route('product.trash')->with('error', 'Sản phẩm không tồn tại trong thùng rác.');
        }

        // Xóa orderDetails nếu có
        if (method_exists($product, 'orderDetails')) {
            if (method_exists($product->orderDetails(), 'forceDelete')) {
                $product->orderDetails()->forceDelete();
            } else {
                $product->orderDetails()->delete();
            }
        }

        $image_path = public_path('assets/images/product/' . $product->thumbnail);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $product->forceDelete();
        return redirect()->route('product.trash')->with('success', 'Đã xóa vĩnh viễn sản phẩm.');
    }

    public function restore(string $id)
    {
        $product = Product::withTrashed()->find($id);
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Sản phẩm không tồn tại!');
        }

        $product->restore();
        return redirect()->route('product.trash')->with('success', 'Khôi phục thành công');
    }
}
