<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'recipient' => 'required|string|max:100',
            'vendor_id' => 'required|integer',
            'order_list' => 'required'
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
            'recipient.required' => 'Recipient is required!',
            'recipient.string' => 'Recipient is string!',
            'recipient.max:100' => 'Recipient should be less than 100 character!',
            'vendor_id.required' => 'Vendor Id is required!',
            'vendor_id.integer' => 'Vendor Id is integer!',
            'order_list.required' => 'Order List is required!',
        ];
    }
}
