<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_uuid' => ['filled', 'uuid', 'max:255', 'exists:categories,uuid'],
            'title' => ['filled', 'string', 'max:255', Rule::unique('products')->ignore($this->uuid)],
            'price' => ['filled', 'numeric'],
            'description' => ['filled', 'string', 'max:255'],
            'metadata' => ['filled', 'json']
        ];
    }


    public function messages()
    {
        return [
            'title.unique' => 'Product with this title is already added',
        ];
    }
}
