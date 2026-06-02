<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Topic;

class PostController extends Controller
{
    // Hiển thị danh sách bài viết
    public function index()
    {
        // Lấy danh sách bài viết trạng thái 1, mới nhất, phân trang 9 bài/trang
        $list_post = Post::where('status', 1)
                         ->orderBy('created_at', 'desc')
                         ->paginate(9);

        return view('frontend.post', compact('list_post'));
    }

    // Hiển thị chi tiết bài viết theo slug
    public function post_detail($slug)
    {
        // Lấy bài viết kèm thông tin chủ đề luôn (eager loading)
        $post = Post::with('topic')
                    ->where('status', 1)
                    ->where('slug', $slug)
                    ->firstOrFail();

        // Lấy bài viết liên quan cùng chủ đề (nếu có)
        $related_posts = collect();
        if ($post->topic_id) {
            $related_posts = Post::where('status', 1)
                                 ->where('topic_id', $post->topic_id)
                                 ->where('id', '!=', $post->id)
                                 ->orderBy('created_at', 'desc')
                                 ->take(5)
                                 ->get();
        }

        return view('frontend.post_detail', [
            'post' => $post,
            'related_posts' => $related_posts,
            'topic' => $post->topic, // đã eager load
        ]);
    }

    // Hiển thị bài viết theo chủ đề
    public function topic($slug)
    {
        // Lấy chủ đề theo slug
        $topic = Topic::where('slug', $slug)
                      ->where('status', 1)
                      ->firstOrFail();

        // Lấy bài viết theo chủ đề, trạng thái 1, phân trang 6 bài/trang
        $list_post = Post::where('status', 1)
                         ->where('topic_id', $topic->id)
                         ->orderBy('created_at', 'desc')
                         ->paginate(6);

        return view('frontend.post_topic', compact('list_post', 'topic'));
    }
}
