<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DivisionRequest extends FormRequest
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
            'divisionName'           => 'required',
            'sort'          		 => 'numeric',
        ];
    }
    public function messages()
    {
        return [
            // message
            'divisionName.required'   => trans('admin.arabic_division_required'),
            'sort.numeric'  		  => trans('admin.sort_numeric'),
        ];
    }
}
