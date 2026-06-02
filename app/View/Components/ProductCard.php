<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    public $productRow = null;

    public function __construct($productRow)
    {
        $this->productRow = $productRow;
    }


    public function render(): View|Closure|string
    {
        $product = $this->productRow;
        return view('components.product-card', compact('product'));
    }
}
