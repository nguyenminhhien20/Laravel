<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;

class ProductSale extends Component
{

    public function __construct()
    {
        //
    }


    public function render(): View|Closure|string
    {
        $product_list = Product::where('status', 1)
            ->where('price_sale', '>', 0)
            ->whereColumn('price_sale', '<', 'price_root') 
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('components.product-sale', compact('product_list'));
    }
}
