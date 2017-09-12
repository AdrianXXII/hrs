<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewPost extends FormRequest
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
            'reviewer.required' => "Der Name ist ein Pflichtfeld.",
            'reviewer.between' => "Der Name soll zwischen :min und :max sein.",
            'review.required' => "Sie müssen ein Kommentar abgeben.",
            'review.max' => "Ihr Kommentar muss länger als 10 Zeichen sein.",
            'rating.required' => "Sie müssen eine Bewertung machen.",
            'rating.required' => "Die Bewertung muss zwischen ;min und :max sein.",
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
            'reviewer' => 'required|between:1,30|',
            'review' => 'required|min:10',
            'rating' => 'required|digits_between:1,5'
        ];
    }
}
