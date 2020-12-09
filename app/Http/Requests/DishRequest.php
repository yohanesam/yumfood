<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishRequest extends FormRequest
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
            "vendor_id"=>'required|integer',
            "dish_name"=>'required|string',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'vendor_id.required' => 'Vendor Id is required!',
            'vendor_id.integer' => 'Vendor Id must be integer!',
            'dish_name.required' => 'Dish Name is required!',
            'dish_name.string' => 'Dish Name must be String!',
        ];
    }
}
