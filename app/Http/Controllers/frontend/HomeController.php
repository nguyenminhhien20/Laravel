<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy 5 bài viết mới nhất trạng thái 1
        $postnew = Post::where('status', 1)
                       ->orderBy('created_at', 'desc')
                       ->take(5)
                       ->get();

        // Truyền biến postnew vào view
        return view('frontend.home', compact('postnew'));
    }
}
