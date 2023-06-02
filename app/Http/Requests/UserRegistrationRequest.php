<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email:filter', 'unique:users,email'],
            'fullname' => ['required', 'string'],
            'username' => ['required', 'string', 'unique:users,username', 'regex:/^[A-Za-z0-9_]+$/'],
            'phone' => ['required', 'string', 'unique:users,phone'],
            'agency' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed'],
        ];
    }
}
