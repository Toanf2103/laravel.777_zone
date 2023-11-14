<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalRequest extends FormRequest
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
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
            'email' => 'nullable|email|unique:accounts,email,' . request()->id,
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'address' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Vui lòng nhập tên nhân viên',
            'phone_number.required' => 'Vui lòng nhập số điện thoại',
            'phone_number.regex' => 'Vui lòng đúng định dạng số điện thoại',
            'phone_number.min' => 'Vui lòng đúng định dạng số điện thoại',
            'phone_number.max' => 'Vui lòng đúng định dạng số điện thoại',
            'email.email' => 'Vui lòng đúng định dạng email',
            'email.unique' => 'Địa chỉ email đã tồn tại',
            'province.required' => 'Vui lòng chọn Tỉnh thành',
            'district.required' => 'Vui lòng chọn Quận huyện',
            'ward.required' => 'Vui lòng chọn Phường xã',
            'address.required' => 'Vui lòng nhập địa chỉ',
        ];
    }
}
