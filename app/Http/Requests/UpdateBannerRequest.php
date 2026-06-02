<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id'); // Lấy ID từ route

        return [
            'name'        => 'required|unique:banner,name,' . $id,
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp,gif',
            'link'        => 'nullable|url|max:255',
            'sort_order'  => 'nullable|integer|min:0',
            'position'    => 'required|string|max:100',
            'description' => 'nullable|string',
            'status'      => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'Tên banner là bắt buộc',
            'name.unique'         => 'Tên banner đã tồn tại',
            'image.image'         => 'File phải là hình ảnh',
            'image.mimes'         => 'Ảnh chỉ chấp nhận các định dạng: jpg, jpeg, png, webp, gif',
            'link.url'            => 'Liên kết không hợp lệ',
            'sort_order.integer'  => 'Thứ tự phải là số',
            'position.required'   => 'Vị trí là bắt buộc',
            'status.required'     => 'Trạng thái là bắt buộc',
        ];
    }
}
