<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardianRequest extends FormRequest
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
            'arFatherName'               => 'required',
            'arGrandName'          		 => 'required',
        ];
    }
    public function messages()
    {
        return [
            // message
            'arFatherName.required'      => trans('admin.arFatherName_required'),
            'arGrandName.required'       => trans('admin.arGrandName_required'),
        ];
    }
}
