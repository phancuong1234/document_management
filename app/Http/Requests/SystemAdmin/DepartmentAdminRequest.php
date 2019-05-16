<?php

namespace App\Http\Requests\SystemAdmin;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentAdminRequest extends FormRequest
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
            'email' => 'required|max:100|unique:users',
            'birth_date' => 'required',
            'avatar' => 'mimes:jpeg,jpg,png,gif|required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email',
            'email.max' => 'Chỉ được nhập tối đa 100 ký tự',
            'email.unique' => 'Email này đã tồn tại, vui lòng nhập email khác',
            'birth_date.required' => 'Vui lòng nhập ngày sinh của admin đơn vị',
            'avatar.mimes' => 'Ảnh không đúng định dạng jpeg, jpg, png, gif',
            'avatar.required' => 'Vui lòng nhập avatar',
        ];
    }
}
