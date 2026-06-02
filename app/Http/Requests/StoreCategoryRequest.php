<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'parent_id' => 'nullable|integer',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên danh mục bắt buộc.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'image.image' => 'File tải lên phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, jpg, png, webp.',
            'image.max' => 'Kích thước hình ảnh tối đa là 2MB.',
            'parent_id.integer' => 'Parent ID phải là số nguyên.',
            'sort_order.integer' => 'Thứ tự sắp xếp phải là số nguyên.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }
}
