<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:user,email',
            'username'  => 'required|string|max:255|unique:user,username',
            'password'  => 'required|string|min:6|',
            'phone'     => 'nullable|string|max:20',
            'address'   => 'nullable|string|max:1000',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:10240',
            'status'    => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'Vui lòng nhập họ tên.',
            'email.required'     => 'Vui lòng nhập email.',
            'email.email'        => 'Email không đúng định dạng.',
            'email.unique'       => 'Email đã tồn tại.',
            'username.required'  => 'Vui lòng nhập tên người dùng.',
            'username.unique'    => 'Tên người dùng đã tồn tại.',
            'password.required'  => 'Vui lòng nhập mật khẩu.',
            'password.min'       => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'status.required'    => 'Vui lòng chọn trạng thái.',
        ];
    }
}
