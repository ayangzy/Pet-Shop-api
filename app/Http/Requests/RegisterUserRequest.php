<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'email'=> 'required|string|unique:users,email',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'avatar' => 'sometimes|nullable|uuid',
            'is_marketing' => 'sometimes|nullable|bool',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
