<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
        $rules = array(
            'email' => 'required|email|unique:users,email,'.\Request('user')->id,
            'name' => 'required',
        );
        $request = $this->request->all();
        if(!empty($request['password'])) {
            $rules['password'] = 'required|confirmed|min:8';
        }
        return $rules;
    }

    public function messages ()
    {
        return [
            'name.required'=> 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be valid email',
            'email.unique' => 'Email already registered',
            'password.required' => 'Password is required',
            'password.confirmation' => 'Confirm Password must be same as Password',
            'password.min' => 'Password must be minimum 8 characters',
        ];
    }
}
