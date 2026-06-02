<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Topic;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Post::select(
            'post.id',
            'post.title',
            'post.slug',
            'post.detail',
            'post.thumbnail',
            'post.description',
            'post.status',
            'topic.name as topic_name'
        )
            ->join('topic', 'post.topic_id', '=', 'topic.id')
            ->orderBy('post.created_at', 'desc')
            ->paginate(5);

        return view('backend.post.index', compact('list'));
    }

    /**
     * Hiển thị form tạo bài viết.
     */
    public function create()
    {
        $list_topic = Topic::where('status', 1)->get();
        return view('backend.post.create', compact('list_topic'));
    }

    /**
     * Lưu bài viết mới vào cơ sở dữ liệu.
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $slug = Str::slug($request->title);

        $post->topic_id    = $request->topic_id;
        $post->title       = $request->title;
        $post->slug        = $request->slug ?? $slug;
        $post->detail      = $request->detail;
        $post->description = $request->description ?? '';
        $post->type        = $request->type;
        $post->status      = $request->status;

        // Nếu không có đăng nhập, gán mặc định 1 (hoặc NULL tùy database)
        $post->created_by  = 1;
        $post->updated_by  = 1;

        // Xử lý file thumbnail nếu có
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->move(public_path('assets/images/post'), $fileName);
            $post->thumbnail = $fileName;
        }

        $post->save();

        return redirect()->route('post.index')->with('success', 'Bài viết đã được tạo thành công.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        return view('backend.post.show', compact('post'));
    }

    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $list_topic = Topic::where('status', 1)->get();

        return view('backend.post.edit', compact('post', 'list_topic'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        // Tìm bài viết cần cập nhật
        $post = Post::findOrFail($id);

        // Tạo slug mới nếu tiêu đề thay đổi
        $slug = Str::slug($request->title);

        // Cập nhật thông tin bài viết
        $post->topic_id    = $request->topic_id;
        $post->title       = $request->title;
        $post->slug        = $request->slug ?? $slug;
        $post->detail      = $request->detail;
        $post->description = $request->description ?? '';
        $post->type        = $request->type;
        $post->status      = $request->status;

        // Cập nhật thông tin người chỉnh sửa
        $post->updated_by  = 1; // Thay bằng ID của người dùng đang đăng nhập

        // Xử lý file thumbnail nếu có và cập nhật
        if ($request->hasFile('thumbnail')) {
            // Xóa ảnh cũ nếu có
            if ($post->thumbnail && file_exists(public_path('assets/images/post/' . $post->thumbnail))) {
                unlink(public_path('assets/images/post/' . $post->thumbnail));
            }

            // Xử lý ảnh mới
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->move(public_path('assets/images/post'), $fileName);
            $post->thumbnail = $fileName;
        }

        // Lưu bài viết đã được cập nhật
        $post->save();

        return redirect()->route('post.index')->with('success', 'Bài viết đã được cập nhật thành công.');
    }
    /**
     * Remove the specified resource from storage.
     */
     public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('post.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        $post->delete(); // Soft delete

        return redirect()->route('post.index')->with('success', 'Sản phẩm đã được chuyển vào thùng rác.');
    }

    public function trash()
    {
        $list = Post::onlyTrashed()
            ->select(
                'post.id',
                'post.title',
                'post.slug',
                'post.detail',
                'post.thumbnail',
                'post.status'
            )
            ->join('topic', 'post.topic_id', '=', 'topic.id')
            ->orderBy('post.created_at', 'desc')
            ->paginate(5);

        return view('backend.post.trash', compact('list'));
    }

    public function delete($id)
    {
        $post = Post::withTrashed()->find($id);

        if (!$post) {
            return redirect()->route('post.trash')->with('error', 'Bài viết không tồn tại trong thùng rác.');
        }

        // Xóa ảnh nếu có
        $image_path = public_path('assets/images/post/' . $post->thumbnail);
        if (\File::exists($image_path)) {
            \File::delete($image_path);
        }

        // Xóa vĩnh viễn bài viết
        $post->forceDelete();

        return redirect()->route('post.trash')->with('success', 'Đã xóa vĩnh viễn bài viết.');
    }


    public function restore(string $id)
    {
        $post = Post::withTrashed()->find($id);

        if (!$post) {
            return redirect()->route('post.index')->with('error', 'Bài viết không tồn tại!');
        }

        $post->restore();

        return redirect()->route('post.trash')->with('success', 'Khôi phục bài viết thành công.');
    }
}
