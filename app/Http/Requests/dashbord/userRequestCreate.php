<?php

namespace App\Http\Requests\dashbord;

use Illuminate\Foundation\Http\FormRequest;

class userRequestCreate extends FormRequest
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
            'id_number' => ['required', 'string', 'max:11'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'user_name' => ['required', 'string', 'min:6', 'max:30', 'unique:users'],
            'phone' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'city' => ['required', 'string',],
            'bank_id' => ['required', 'numeric', 'unique:users,bank_id'],
            'gender' => ['required', 'numeric'],
            'permissions' => ['required', 'array'],

        ];
    }
}
