<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order_id'    => 'required|exists:order,id',
            'product_id'  => 'required|exists:product,id',
            'price_buy'   => 'required|numeric|min:0',
            'qty'         => 'required|integer|min:1',
            'amount'      => 'required|numeric|min:0',
        ];
    }
}
