<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages ()
    {
        return [
            'first_name.'=> 'First Name is required',
            'last_name.'=> 'Last Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be valid email',
            'email.unique' => 'Email already registered',
            'phone_number.required' => 'Phone Number is required',
            'phone_number.unique' => 'Phone Number already registered',
            'password.required' => 'Password is required',
            'password.confirmation' => 'Confirm Password must be same as Password',
            'password.min' => 'Password must be minimum 8 characters',
            'dob.date_format' => 'Date must be in format Y-m-d',
        ];
    }
}
