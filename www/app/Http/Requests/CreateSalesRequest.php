<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSalesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'seller' => 'required',
            'code' => 'required|unique:sales',
            'customer' => 'required',
            'taxPrice' => 'required',
            'netPrice' => 'required',
            'total' => 'required',
            'date' => 'required|date',
            'PaymentMethod' => 'required',
            'profuctName' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ];
    }
}
