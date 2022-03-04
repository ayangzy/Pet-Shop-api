<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'category_uuid' => ['required', 'uuid', 'max:255', 'exists:categories,uuid'],
            'title' => ['required', 'string', 'max:255', 'unique:products,title'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string', 'max:255'],
            'metadata' => ['required', 'json']
        ];
    }


    public function messages()
    {
        return [
            'title.unique' => 'Product with this title already exist' 
        ];
    }
}
