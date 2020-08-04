<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            // rules
            'part'              => 'required',
            'fees_id'           => 'required',
            'date_pay'          => 'required',
            'amount'            => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            // message
            'part.required'      => trans('admin.part_required'),
            'fees_id.required'   => trans('admin.fees_id_required'),
            'date_pay.required'  => trans('admin.date_pay_required'),
            'amount.required'    => trans('admin.amount_required'),
            'amount.numeric'  	 => trans('admin.numeric_numeric'),
        ];
    }
}
