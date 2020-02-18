<?php

namespace App\Http\Requests\dashbord;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class userRequestUpdate extends FormRequest
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
            
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->email,'email')],
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'user_name' => ['required', 'string', 'min:6','max:30',Rule::unique('users')->ignore($this->user_name,'user_name')],
            'phone' => ['required', 'string', 'min:8'],
           
            'city' => ['required', 'string', ],
            'gender' => ['required', 'numeric'],
        ];
    }
}
