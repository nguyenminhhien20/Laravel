<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'description' => 'nullable|string|max:500',
            'status' => 'nullable|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên thương hiệu bắt buộc.',
            'name.max' => 'Tên thương hiệu không được vượt quá 255 ký tự.',
            'sort_order.integer' => 'Thứ tự sắp xếp phải là số nguyên.',
            'description.max' => 'Mô tả không được vượt quá 500 ký tự.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'image.image' => 'File tải lên phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, jpg, png, webp.',
            'image.max' => 'Kích thước hình ảnh tối đa là 2MB.',
        ];
    }
}
