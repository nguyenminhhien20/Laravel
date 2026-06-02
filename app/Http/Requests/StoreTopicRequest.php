<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTopicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:topic,name',
            'slug' => 'nullable|string|max:255|unique:topic,slug',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên chủ đề.',
            'name.unique' => 'Tên chủ đề đã tồn tại.',
            'slug.unique' => 'Slug đã tồn tại.',
            'slug.max' => 'Slug không được vượt quá 255 ký tự.',

            'description.string' => 'Mô tả phải là chuỗi.',

            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ. Chỉ được chọn 0 hoặc 1.',
        ];
    }
}
