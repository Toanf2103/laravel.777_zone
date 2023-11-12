<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|unique:products,name,' . request()->id,
            'price' => 'required|integer|gt:0',
            'quantity' => 'required|integer|gt:0',
            'images' => 'nullable|array',
            'images.*' => 'required|image|max:2048',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'price.required' => 'Vui lòng nhập đơn giá',
            'price.integer' => 'Đơn giá phải là số nguyên',
            'price.gt' => 'Đơn giá phải là số nguyên dương',
            'quantity.required' => 'Vui lòng nhập số lượng sản phẩm',
            'quantity.integer' => 'Số lượng sản phẩm phải là số nguyên',
            'quantity.gt' => 'Số lượng sản phẩm phải là số nguyên dương',
            'images.required' => 'Vui lòng chọn ảnh',
            'images.array' => 'Vui lòng chọn ít nhất một ảnh',
            'images.*.image' => 'Image phải là một tệp hình ảnh',
            'images.*.max' => 'Kích thước image không vượt quá 2MB',
            'status' => 'Vui lòng chọn trạng thái'
        ];
    }
}
