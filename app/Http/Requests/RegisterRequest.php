<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'email_register' => "required|email|unique:users,email",
            'password_register' => "required|min:8",
            'name' => "required",
        ];

        if(request()->get('phone')){
            $rules['phone'] = "numeric|unique:users,phone";
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ":attribute bắt buộc phải nhập",
            'email' => "Email không đúng định dạng",
            'unique' => ":attribute đã tồn tại trên hệ thống",
            'min' => ":attribute phải tối thiểu :min kí tự",
            'numeric' => ":attribute phải là số"
        ];
    }

    public function attributes()
    {
        return [
            'email_register' => "Email",
            'password_register' => "Mật khẩu",
            'name' => "Họ và tên",
            'phone' => "Số điện thoại"
        ];
    }
}
