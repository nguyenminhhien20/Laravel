<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Product;

class ProductBestseller extends Component
{
    public $product_bestseller;

    public function __construct()
    {
        $this->product_bestseller = Product::where('status', 1)
            ->orderBy('sold', 'desc')
            ->take(10)
            ->get();
    }

    public function render()
    {
        return view('components.product-bestseller', [
            'product_bestseller' => $this->product_bestseller
        ]);
    }
}
