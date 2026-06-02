<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'name'        => 'required|unique:menu,name',
            'link'        => 'nullable|string|max:255',
            'table_id'    => 'nullable|integer',
            'parent_id'   => 'nullable|integer',
            'sort_order'  => 'nullable|integer',
            'type'        => 'required|in:custom,category,page',
            'position'    => 'nullable|string|max:255', // Cho phép người dùng nhập giá trị tự do
            'status'      => 'required|in:0,1',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'     => 'Tên menu không được để trống',
            'name.unique'       => 'Tên menu đã tồn tại',
            'link.string'       => 'Link phải là chuỗi ký tự',
            'table_id.integer'  => 'Table ID phải là số',
            'parent_id.integer' => 'Menu cha phải là số',
            'sort_order.integer'=> 'Thứ tự sắp xếp phải là số',
            'type.required'     => 'Loại menu là bắt buộc',
            'type.string'       => 'Loại menu phải là chuỗi',
            'type.in'           => 'Loại menu không hợp lệ (chỉ chấp nhận: custom, category, page)',
            'position.string'   => 'Vị trí phải là chuỗi ký tự',
            'position.max'      => 'Vị trí không được vượt quá 255 ký tự',
            'status.required'   => 'Trạng thái là bắt buộc',
            'status.in'         => 'Trạng thái không hợp lệ (chỉ chấp nhận 0 hoặc 1)',
        ];
    }
}
