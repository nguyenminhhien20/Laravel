<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostNew extends Component
{
    public $postnew;

    /**
     * Tạo một instance của component.
     * Bạn có thể truyền dữ liệu từ controller, hoặc để component tự lấy.
     */
    public function __construct($postnew = null)
    {
        // Nếu không truyền từ ngoài vào thì tự lấy bài viết mới nhất
        $this->postnew = $postnew ?? Post::where('status', 1)
                                          ->orderBy('created_at', 'desc')
                                          ->take(6)
                                          ->get();
    }

    /**
     * Trả về view tương ứng của component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post-new', [
            'postnew' => $this->postnew
        ]);
    }
}
