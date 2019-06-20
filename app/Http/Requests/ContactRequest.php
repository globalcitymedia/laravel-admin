<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'email' => 'required|email|max:255|unique:contacts,email'
        ];

        if($this->method() == 'PATCH'):
            $url = explode('/',$this->path());
            $email_id = array_last($url);
            //dd($url);
            $rules ['email'] = 'required|email|max:255|unique:contacts,email,'.$email_id;
        endif;


        return $rules;
    }
}
