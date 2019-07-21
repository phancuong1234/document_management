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
            'avatar' => 'mimes:jpeg,jpg,png,gif',
            'username' => 'required|max:100|unique:users',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email',
            'email.max' => 'Chỉ được nhập tối đa 100 ký tự',
            'email.unique' => 'Email này đã tồn tại, vui lòng nhập email khác',
            'avatar.mimes' => 'Ảnh không đúng định dạng jpeg, jpg, png, gif',
            'username.required' => 'Vui lòng nhập username',
            'username.max' => 'Chỉ được nhập tối đa 100 ký tự',
            'username.unique' => 'Tên đăng nhập này đã tồn tại, vui lòng nhập tên đăng nhập khác',
        ];
    }
}
