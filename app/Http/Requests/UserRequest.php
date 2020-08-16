<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = request()->segment(3);
        return [
            'name'                  => 'required|string|max:20',
            'email'                 => 'required|unique:admins,email,'.$id,
            'cPassword'             => 'same:password'
        ];
    }
    public function messages()
    {
        return [
            'name.required'         => trans('admin.account_name_required'),
            'name.string'           => trans('admin.account_name_string'),
            'name.max'              => trans('admin.account_name_max'),
            'email.required'        => trans('admin.email_required'),
            'email.unique'          => trans('admin.email_unique'),
            'cPassword.same'        => trans('msg.match_password'),
        ];
    }
}
