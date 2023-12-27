<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicineRequest extends FormRequest
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

            'name' => 'required',
            'strength' => 'required',
            'alert_quantity' => 'required',
            'expDate' => 'required',
            'pprice' => 'required',
            'sprice' => 'required',
            'manufacture_id' => 'required',
            'category_id' => 'required',
            'supply_id' => 'required',
            'type_id' => 'required',

        ];
    }
}
