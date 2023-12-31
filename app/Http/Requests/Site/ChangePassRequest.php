<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassRequest extends FormRequest
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
            'current_pass'=>'nullable',
            'new_pass'=>'required|min:6|max:20|different:current_pass',
            'cofirm_new_pass'=>'required|min:6|max:20|same:new_pass',
        ];
    }
    public function messages(): array
    {
        return [
            'current_pass.required' => 'Mật khẩu cũ không được bỏ trống',
            'new_pass.required' => 'Mật khẩu mới không được bỏ trống',
            'cofirm_new_pass.required' => 'Mật khẩu xác nhận không được bỏ trống',
            'new_pass.min'=>'Mật khẩu phải có ít nhất 6 ký tự',
            'cofirm_new_pass.min'=>'Mật khẩu phải có ít nhất 6 ký tự',
            'new_pass.max'=>'Mật khẩu phải ít hơn 20 ký tự',
            'cofirm_new_pass.max'=>'Mật khẩu phải ít hơn 20 ký tự',
            'new_pass.different'=>'Mật khẩu mới không được trùng với mật khẩu cũ',
            'cofirm_new_pass.same'=>'Mật khẩu xác nhận không trùng khớp',
        ];
    }
}
