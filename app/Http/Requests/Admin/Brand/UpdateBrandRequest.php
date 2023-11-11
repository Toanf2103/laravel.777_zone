<?php

namespace App\Http\Requests\Admin\Brand;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
            'name' => 'required|unique:brands,name,' . request()->id,
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên thương hiệu',
            'name.unique' => 'Tên thương hiệu đã tồn tại',
            'image.required' => 'Vui lòng chọn hình ảnh thương hiệu',
            'image.image' => 'Hình ảnh thương hiệu phải là một tệp hình ảnh',
            'image.max' => 'Kích thước hình ảnh thương hiệu không vượt quá 2MB',
            'status' => 'Vui lòng chọn trạng thái'
        ];
    }
}
