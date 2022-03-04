<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'first_name' => ['filled', 'string', 'max:255'],
            'last_name' => ['filled', 'string', 'max:255'],
            'avatar' => ['sometimes', 'nullable', 'uuid'],
            'is_marketing' => ['sometimes', 'nullable', 'bool'],
            'address' => ['filled', 'string', 'max:255'],
            'phone_number' => ['filled', 'string', 'max:15'],
            'email' => ['filled', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'password' => ['filled', 'confirmed'],
        ];
    }
}
