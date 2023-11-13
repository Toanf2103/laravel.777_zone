<?php

namespace App\Http\Requests\Admin\Employee;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'nullable|email|unique:accounts,email',
            'username' => 'required|unique:accounts,username',
            'ward' => 'required',
            'address' => 'required',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Vui lòng nhập tên nhân viên',
            'phone_number.required' => 'Vui lòng nhập số điện thoại',
            'phone_number.regex' => 'Vui lòng đúng định dạng số điện thoại',
            'phone_number.min' => 'Vui lòng đúng định dạng số điện thoại',
            'email.email' => 'Vui lòng đúng định dạng email',
            'email.unique' => 'Địa chỉ email đã tồn tại',
            'username.required' => 'Vui lòng nhập username',
            'username.unique' => 'Username đã tồn tại',
            'ward.required' => 'Vui lòng chọn địa chỉ',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'status' => 'Vui lòng chọn trạng thái'
        ];
    }
}
