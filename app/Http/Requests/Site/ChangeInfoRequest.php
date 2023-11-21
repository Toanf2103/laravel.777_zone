<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ChangeInfoRequest extends FormRequest
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
            'full_name' => 'required',
            'phone_number' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
            'email' =>'nullable|unique:accounts,email',
            'address' =>'nullable|max:240'
        ];
    }
    public function messages(): array
    {
        return [
            'full_name.required' => 'Tên không được bỏ trống',
            'phone_number.regex' => 'Vui lòng đúng định dạng số điện thoại',
            'phone_number.min' => 'Vui lòng đúng định dạng số điện thoại',
            'phone_number.max' => 'Vui lòng đúng định dạng số điện thoại',
            'email.unique' =>'Email bạn nhập đã được sử dụng',
            'address.max' =>'Địa chỉ không quá 240 ký tự'
        ];
    }
}
