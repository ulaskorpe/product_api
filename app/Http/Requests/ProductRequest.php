<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
             'price' => 'required|numeric|min:0',
            'status' => [
                'required',
                Rule::in(['sold_out', 'available', 'reserved']),
            ],
            
            'type' => [
                'required',
                Rule::in(['product', 'service']),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.in'=>'name is required max 255 chars',
            'status.in' => 'The status field must be one of: sold_out, available, reserved.',
            'type.in' => 'The type field must be one of: product, service.',
        ];
    }
}
