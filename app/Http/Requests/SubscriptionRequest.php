<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ReCaptcha;


class SubscriptionRequest extends FormRequest
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
        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:contacts,email',
            'contact_lists' => 'required',
            'g-recaptcha-response' => ['required', new Recaptcha],
        ];

        if($this->method() == 'PATCH'):
            $url = explode('/',$this->path());
            $email_id = array_last($url);
            //dd($url);
            $rules ['email'] = 'required|email|max:255|unique:contacts,email,'.$email_id;
            $rules ['password'] = '';
        endif;

        return $rules;
    }


    public function messages()
    {

        $messages = [
            'first_name'    => 'The :attribute and :other must match.',
            'last_name'    => 'The :attribute must be exactly :size.',
            'email' => 'The :attribute value :input is not between :min - :max.',
            'contact_lists'      => 'The :attribute must be one of the following',
        ];

        return $messages;
    }
}
