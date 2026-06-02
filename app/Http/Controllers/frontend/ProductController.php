<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm, có hỗ trợ lọc theo category, brand, price, keyword
    public function index(Request $request)
    {
        $query = Product::where('status', 1);

        $category = $request->category ?? null;
        $brand = $request->brand ?? null;
        $priceRanges = $request->price ?? []; // Mảng price[] từ checkbox
        $keyword = $request->keyword ?? null; // Tìm kiếm theo tên

        // Lọc theo category
        if ($category) {
            $listcategoryid = $this->getlistcategoryid($category);
            $query->whereIn('category_id', $listcategoryid);
        }

        // Lọc theo brand
        if ($brand) {
            $query->where('brand_id', $brand);
        }

        // Lọc theo keyword (search)
        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        }

        // Lọc theo nhiều khoảng giá
        if (!empty($priceRanges)) {
            $query->where(function ($q) use ($priceRanges) {
                foreach ($priceRanges as $range) {
                    [$min, $max] = explode('-', $range);
                    $q->orWhere(function ($sub) use ($min, $max) {
                        $sub->whereRaw(
                            'IF(price_sale > 0, price_sale, price_root) BETWEEN ? AND ?',
                            [(int) $min, (int) $max]
                        );
                    });
                }
            });
        }

        // Lấy danh sách brand & category để filter bên view
        $brand_list = Brand::where('status', 1)->orderBy('sort_order', 'asc')->get();
        $category_list = Category::where('status', 1)->orderBy('sort_order', 'asc')->get();

        // Lấy danh sách sản phẩm phân trang
        $product_list = $query->with(['category', 'brand'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Nếu là request AJAX thì chỉ render danh sách sản phẩm
        // if ($request->ajax()) {
        //     return view('frontend.product-ajax', compact('product_list'));
        // }
        if ($request->ajax()) {
            return view('frontend.partials.product-list', compact('product_list'));
        }

        // Trả về trang đầy đủ
        return view('frontend.product', compact('product_list', 'category_list', 'brand_list'));
    }

    // Lấy danh sách ID category con cho category cha truyền vào
    public function getlistcategoryid($categoryid)
    {
        $listcatid = [$categoryid];
        $categories = Category::where('status', 1)->where('parent_id', $categoryid)->get();

        while ($categories->isNotEmpty()) {
            $listcatid = array_merge($listcatid, $categories->pluck('id')->toArray());
            $categories = Category::whereIn('parent_id', $categories->pluck('id'))->get();
        }

        return $listcatid;
    }

    // Hiển thị chi tiết 1 sản phẩm
    public function product_detail($slug)
    {
        $product = Product::where([
            ['slug', '=', $slug],
            ['status', '=', 1],
        ])->firstOrFail();

        $listcategoryid = $this->getlistcategoryid($product->category_id);

        $product_list = Product::with(['category', 'brand'])
            ->where('status', 1)
            ->where('id', '!=', $product->id)
            ->whereIn('category_id', $listcategoryid)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('frontend.product_detail', compact('product', 'product_list'));
    }

    // Lọc sản phẩm theo danh mục qua slug category
    public function category($slug, Request $request)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $request->merge(['category' => $category->id]);

        return $this->index($request);
    }

    // Lọc sản phẩm theo thương hiệu qua slug brand
    public function brand($slug, Request $request)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $request->merge(['brand' => $brand->id]);

        return $this->index($request);
    }
    //
    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('keyword');
        $products = Product::where('status', 1)
            ->where('name', 'like', "%{$keyword}%")
            ->limit(5)
            ->get(['id', 'name', 'slug']); // chỉ lấy dữ liệu cần

        return response()->json($products);
    }
}
