<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Đảm bảo người dùng có quyền sửa bài viết
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'topic_id' => 'required|exists:topic,id', // Kiểm tra rằng topic_id phải tồn tại trong bảng topics
            'detail' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1', // Chỉ nhận giá trị 0 hoặc 1 cho status
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Kiểm tra loại file ảnh và dung lượng
        ];
    }

    /**
     * Tùy chỉnh thông báo lỗi.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'topic_id.required'   => 'Chủ đề bài viết là bắt buộc.',
            'topic_id.exists'     => 'Chủ đề bài viết không hợp lệ.',
            'title.required'      => 'Tiêu đề bài viết là bắt buộc.',
            'title.max'           => 'Tiêu đề bài viết không được quá 255 ký tự.',
            'detail.required'     => 'Nội dung bài viết là bắt buộc.',
            'status.required'     => 'Trạng thái bài viết là bắt buộc.',
            'status.in'           => 'Trạng thái bài viết chỉ có thể là "Hiển thị" hoặc "Ẩn".',
            'thumbnail.image'     => 'Ảnh thumbnail phải là một file hình ảnh.',
            'thumbnail.mimes'     => 'Ảnh thumbnail chỉ chấp nhận các định dạng: jpg, jpeg, png, gif.',
            'thumbnail.max'       => 'Ảnh thumbnail không được vượt quá 2MB.',
        ];
    }
}
