<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Topic::select('id', 'name', 'slug', 'description', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('backend.topic.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.topic.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTopicRequest $request)
    {
        $topic = new Topic();
        $topic->name = $request->name;
        $topic->slug = Str::slug($request->name);
        $topic->description = $request->description;
        $topic->status = $request->status;
        $topic->created_by = Auth::id() ?? 1;
        $topic->updated_by = Auth::id() ?? 1;
        $topic->save();

        return redirect()->route('topic.index')->with('success', 'Thêm chủ đề thành công!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    { {
            $topic = Topic::withTrashed()->findOrFail($id);
            return view('backend.topic.show', compact('topic'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $topic = Topic::findOrFail($id); // Tìm chủ đề theo ID hoặc 404 nếu không tồn tại

        return view('backend.topic.edit', compact('topic'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTopicRequest $request, $id)
    {
        // Lấy đối tượng topic từ DB
        $topic = Topic::findOrFail($id);

        // Kiểm tra slug, bỏ qua nếu slug không thay đổi
        $slug = Str::slug($request->name);
        if ($topic->slug !== $slug && Topic::where('slug', $slug)->exists()) {
            return redirect()->back()->with('error', 'Slug đã tồn tại, vui lòng chọn một slug khác');
        }

        // Cập nhật các trường
        $topic->name = $request->name;
        $topic->slug = $slug;
        $topic->description = $request->description;
        $topic->status = $request->status;
        $topic->updated_by = Auth::id() ?? 1; // Chỉ update 'updated_by'

        // Lưu thay đổi
        $topic->save();

        return redirect()->route('topic.index')->with('success', 'Cập nhật chủ đề thành công!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $topic = Topic::find($id);

        if (!$topic) {
            return redirect()->route('topic.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        $topic->delete(); // Soft delete

        return redirect()->route('topic.index')->with('success', 'Sản phẩm đã được chuyển vào thùng rác.');
    }




    public function trash()
    {
        $list = Topic::onlyTrashed('id', 'name', 'slug', 'description', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('backend.topic.trash', compact('list'));
    }
    public function delete($id)
    {
        $topic = Topic::withTrashed()->find($id);

        if (!$topic) {
            return redirect()->route('topic.trash')->with('error', 'chủ đề không tồn tại trong thùng rác.');
        }

      
        // Xóa vĩnh viễn bài viết
        $topic->forceDelete();

        return redirect()->route('topic.trash')->with('success', 'Đã xóa vĩnh viễn chủ đề.');
    }


    public function restore(string $id)
    {
        $topic = Topic::withTrashed()->find($id);

        if ($topic == null) {
            return redirect()->route('topic.index')->with('error', 'Mẫu tin không tồn tại!');
        }

        $topic->restore();

        return redirect()->route('topic.trash')->with('success', 'Khôi phục thành công');
    }
}
