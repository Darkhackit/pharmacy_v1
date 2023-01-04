<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPurchaseRequest extends FormRequest
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

            'manufacture_id' => 'required',
            'date' => 'required',
            'invoice' => 'required',
            'payment' => 'required',
            'expirydate' => 'required|array',
            'quantity' => 'required|array',
            'purchase_price' => 'required|array',
            'newPrice' => 'required|array',
            'netTotal' => 'required|array',
            'total' => 'required',
            'medicine' => 'required|array',
        ];
    }
}
