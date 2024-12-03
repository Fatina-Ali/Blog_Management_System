<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends MainRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name'=>['required','string'],
            'last_name'=>['required','string'],
            'user_name'=>['required','string'],
            'profile_photo' =>['required','file','mimes:png,jpg'],
            'email'=>['required' ,'email','unique:users,email'],
            'password'=>['string','required','min:12','max:20','regex:/[A-Z]/','regex:/[a-z]/','regex:/[0-9]/','regex:/[!@#?$%&*]/','not_in:123456,password',
        'not_regex:/'.preg_quote($this->user_name,'/').'/','not_regex:/'.preg_quote($this->email,'/').'/'],
        ];
    }
    public function messages(){
        return[
            'password.regex'=>'The password must contain a capital letter, a small letter, a number and a special code.',
            'password.not_in'=>'The password is quite common.',
            'password.not_regex'=>'The password cannot contain parts of the username or email.'
        ];
    }
}
