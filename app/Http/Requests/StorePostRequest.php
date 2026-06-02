<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cho phép mọi người gửi request, không cần đăng nhập
    }

    public function rules()
    {
        return [
            'title'       => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:post,slug',
            'detail'      => 'required|string',
            'description' => 'nullable|string',
            'topic_id'    => 'required|exists:topic,id',
            'type'        => 'required|in:post,page',
            'status'      => 'required|boolean',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required'    => 'Vui lòng nhập tiêu đề.',
            'slug.unique'       => 'Slug đã tồn tại.',
            'detail.required'   => 'Vui lòng nhập nội dung chi tiết.',
            'topic_id.required' => 'Vui lòng chọn chủ đề.',
            'topic_id.exists'   => 'Chủ đề không tồn tại.',
            'type.required'     => 'Vui lòng chọn loại bài viết.',
            'status.required'   => 'Vui lòng chọn trạng thái.',
            'thumbnail.image'   => 'File tải lên phải là hình ảnh.',
            'thumbnail.mimes'   => 'Chỉ chấp nhận định dạng jpg, jpeg, png, gif.',
            'thumbnail.max'     => 'Dung lượng ảnh tối đa 2MB.',
        ];
    }
}
