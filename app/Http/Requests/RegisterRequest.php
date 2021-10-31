<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstName' => ['string', 'required'],
            'lastName' => ['string', 'required'],
            'otherNames' => ['string', 'nullable'],
            'userName' => ['alpha_dash', 'required', 'unique:users,username'],
            'email' => ['email', 'nullable'],
            'password' => ['alpha_dash', 'required', 'confirmed'],
        ];
    }

    
    public function messages()
    {
        return [
            'userName.unique' => 'sorry, the username provided has already been taken 😏'
        ];
    }
}
