<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'username' => 'required',
            'phone-number' => 'required',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'type-pay' => 'required|in:momo,vnay,cod',
            'products' => 'required'
        ];
    }
    public function messages()
    {
        
    }
}
