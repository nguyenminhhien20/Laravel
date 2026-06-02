<?php
namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;
use App\Models\Category;

class ProductCategory extends Component
{
    public $category;
    public $category_list;

    /**
     * Tạo một instance mới cho component.
     *
     * @param string $category
     * @param $category_list
     * @return void
     */
    public function __construct($category, $category_list)
    {
        $this->category = $category;
        $this->category_list = $category_list;
    }

    /**
     * Lấy view / nội dung đại diện cho component
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|string
    {
        // Lấy danh mục từ slug
        $category = Category::where('slug', $this->category)->first();

        if ($category) {
            // Lấy sản phẩm thuộc danh mục này
            $product_list = Product::where('category_id', $category->id)
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        } else {
            $product_list = collect();  // Trả về danh sách rỗng nếu không tìm thấy danh mục
        }

        return view('components.product-category', compact('product_list'));
    }
}
