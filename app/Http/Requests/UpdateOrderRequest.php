<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'            => 'required|string|max:255',
            'phone'           => 'required|string|max:15',
            'email'           => 'required|email|max:255',
            'address'         => 'required|string|max:500',
            'address_detail'  => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[\p{L}0-9\s\/\-,.]+$/u',
            ],
            'note'            => 'nullable|string|max:1000',
            'status'          => 'required|in:0,1',
            'user_id'         => 'required|exists:user,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên người liên hệ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'address_detail.regex' => 'Địa chỉ chi tiết chỉ được chứa chữ, số, khoảng trắng và các ký tự / - , .',
            'status.required' => 'Vui lòng chọn trạng thái',
            'user_id.required' => 'Vui lòng chọn người dùng',
            'user_id.exists' => 'Người dùng không tồn tại',
        ];
    }
}
