<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Brand; // ✅ Thêm dòng này

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Truyền danh mục và thương hiệu cho tất cả các view
        View::composer('*', function ($view) {
            $category_list = Category::where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->get();

            $brand_list = Brand::where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->get();

            $view->with(compact('category_list', 'brand_list'));
        });
    }
}
