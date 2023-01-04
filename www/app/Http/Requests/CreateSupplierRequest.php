<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierRequest extends FormRequest
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

            'company_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'acct' => 'required',
            'description' => 'required',

        ];
    }
}
