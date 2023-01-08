<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMedicineRequest extends FormRequest
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
            'code' => 'unique:medicines',
            'name' => 'required|unique:medicines',
            'strength' => 'required',
            'halfLife' => 'required',
            'alert_quantity' => 'required',
            'expDate' => 'required',
            'stock' => 'required',
            'pprice' => 'required',
            'sprice' => 'required',
            'manufacture_id' => 'required',
            'category_id' => 'required',
            'supply_id' => 'required',
            'type_id' => 'required',
            'unit_id' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:90000',
        ];
    }
}
