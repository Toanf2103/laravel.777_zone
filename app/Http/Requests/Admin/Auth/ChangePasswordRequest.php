<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
        return [
            'password_old' => 'required',
            'password_new' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'password_new_confirm' => 'same:password_new',
        ];
    }

    public function messages(): array
    {
        return [
            'password_old.required' => 'Mật khẩu cũ không được để trống',
            'password_new.required' => 'Mật khẩu mới không được để trống',
            'password_new.min' => 'Mật khẩu mới phải chứa ít nhất một chữ cái thường, một chữ cái in hoa và một số',
            'password_new.regex' => 'Mật khẩu mới phải chứa ít nhất một chữ cái thường, một chữ cái in hoa và một số',
            'password_new_confirm.same' => 'Mật khẩu xác nhận phải trùng với mật khẩu mới',
        ];
    }
}
