<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'arStudentName'     => 'required',
            'enStudentName'     => 'required',
            'gender'            => 'required',
            'reg_type'          => 'required',
            'reg_status'        => 'required',
            'nativeLang'        => 'required',
            'second_lang'        => 'required',
            'dob'               => 'required',
            'nationality'       => 'required',
            'religion'          => 'required',
            'grade_id'          => 'required',
            'division_id'       => 'required',
        ];
    }
    public function messages()
    {
        return [
            'arStudentName.required'    => trans('admin.arStudentName_required'),
            'enStudentName.required'    => trans('admin.enStudentName_required'),
            'gender.required'           => trans('admin.gender_required'),
            'reg_type.required'         => trans('admin.reg_type_required'),
            'reg_status.required'       => trans('admin.reg_status_required'),
            'nativeLang.required'       => trans('admin.nativeLang_required'),
            'second_lang.required'      => trans('admin.secondLang_required'),
            'dob.required'              => trans('admin.dob_required'),
            'nationality.required'      => trans('admin.nationality_required'),
            'religion.required'         => trans('admin.religion_required'),
            'grade_id.required'         => trans('admin.grade_id_required'),
            'division_id.required'      => trans('admin.division_id_required'),

        ];
    }
}
