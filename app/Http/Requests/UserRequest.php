<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [];

        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password'   => 'required|min:6|max:15|confirmed',
        ];


        if($this->method() == 'PATCH'):
            $url = explode('/',$this->path());
            $user_id = array_last($url);
            //dd($url);
            $rules ['email'] = 'required|email|max:255|unique:users,email,'.$user_id;
            $rules ['password'] = '';
        endif;


        return $rules;
    }
}
