<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name'        => [
                'required',
                Rule::unique('product')->ignore($this->route('product')),
            ],
            'detail'      => 'required',
            'price_root'  => 'required',
            'price_sale'  => 'required',
            'qty'         => 'required',
            'category_id' => 'required',
            'brand_id'    => 'required',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,gif,webp',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Tên sản phẩm không để trống',
            'name.unique'          => 'Tên sản phẩm đã tồn tại',
            'detail.required'      => 'Thông tin chi tiết là bắt buộc',
            'price_root.required'  => 'Giá gốc là bắt buộc',
            'price_sale.required'  => 'Giá khuyến mãi là bắt buộc',
            'qty.required'         => 'Số lượng là bắt buộc',
            'category_id.required' => 'Danh mục là bắt buộc',
            'brand_id.required'    => 'Thương hiệu là bắt buộc',
            'thumbnail.image'      => 'Ảnh phải là định dạng hình ảnh hợp lệ',
        ];
    }
}

