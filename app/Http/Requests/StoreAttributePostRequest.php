<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttributePostRequest extends FormRequest
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
     * @return array
     */
    public function messages()
    {
        return [
            'description.required' => 'Sie müssen der Zusatzleistung eine Beschreibung angeben!',
            'description.max' => 'Die Beschreibung ist zu lange!',
            'description.min' => 'Die Beschreibung ist zu kurz!',
            'hotel_atr.required' => 'Sie müssen einen Vornamen angeben!',
            'hotel_atr.boolean' => 'Die Angabe ist ungültig!'
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
            //
            'description' => 'required|min:3|max:50',
            'hotel_atr' => 'required|boolean'
        ];
    }
}
