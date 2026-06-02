<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Nếu bạn có kiểm tra quyền truy cập, có thể thay đổi ở đây.
    }

    public function rules(): array
    {
        // Lấy ID từ route hoặc đặt mặc định là null
        $id = $this->route('id') ?? null;

        // Kiểm tra xem đây là store hay update
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);

        return [
            'name'        => [
                'required',
                $isUpdate
                    ? 'unique:banner,name,' . $id  // Bỏ qua chính nó khi update
                    : 'unique:banner,name',        // Store: phải duy nhất
            ],
            'image'       => $isUpdate
                            ? 'nullable|image|mimes:jpg,jpeg,png,webp,gif'
                            : 'required|image|mimes:jpg,jpeg,png,webp,gif',
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
