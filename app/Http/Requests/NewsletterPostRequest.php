<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterPostRequest extends FormRequest
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
     * Get The error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'subject.required' => 'Sie müssen einen Betreff angeben!',
            'body.required' => 'Sie müssen eine Nachricht angeben!'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject' => 'required',
            'body' => 'required',
        ];
    }
}
