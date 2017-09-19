<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateHotelPostRequest extends FormRequest
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
            'name.required' => 'Sie müssen einen Hotelnamen angeben!',
            'description.required' => 'Sie müssen einen Beschreibung angeben!',
            'stars.required' => 'Sie müssen die Anzahl Sterne angeben!',
            'street.required' => 'Sie müssen eine Strasse angeben!',
            'postalcode.required' => 'Sie müssen eine Postleitzahl angeben!',
            'area.required' => 'Sie müssen einen Ort angeben!',
            'phone.required' => 'Sie müssen eine Telefonnummer angeben!',
            'phone.regex' => 'Sie müssen eine gültige Telefonnummer angeben!',
            'fax.required' => 'Sie müssen eine Faxnummer angeben!',
            'fax.regex' => 'Sie müssen eine gültige Faxnummer angeben!',
            'email.required' => 'Sie müssen eine E-Mail Adresse angeben!',
            'email.email' => 'Sie müssen eine gültige E-Mail Adresse angeben!',
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
            'name' => 'required',
            'description' => 'required',
            'stars' => 'required|integer|between:1,5',
            'street' => 'required',
            'postalcode' => 'required',
            'area' => 'required',
            'phone' => ['required',
                        'regex:/^(?=.*[0-9])[ +()0-9]+$/'
            ],
            'fax' => ['required',
                        'regex:/^(?=.*[0-9])[ +()0-9]+$/'
            ],
            'email' => 'required|email',
            'managers' => ''
        ];
    }
}
