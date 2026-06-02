<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTopicRequest extends FormRequest
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
        $id = $this->route('id'); // Lấy ID từ route

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('topic', 'name')->ignore($id), // Bỏ qua chính nó khi update
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('topic', 'slug')->ignore($id), // Bỏ qua slug cũ khi update
            ],
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
        ];
    }

    /**
     * Get custom error messages for validator.
     */
    public function messages(): array
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
