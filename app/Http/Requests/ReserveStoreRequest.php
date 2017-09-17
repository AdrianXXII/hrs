<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveStoreRequest extends FormRequest
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
            'name.required', 'Sie müssen Ihren Namen angeben',
            'name.max', 'Ihr Name darf nicht länger als 30 Zeichen sein',
            'name.min', 'Ihr Name darf nicht kürzer als 2 Zeichen sein',
            'firstname.required', 'Sie müssen Ihren Vornamen angeben',
            'firstname.max', 'Ihr Vorname darf nicht länger als 30 Zeichen sein',
            'firstname.min', 'Ihr Vorname darf nicht kürzer als 2 Zeichen sein',
            'email.requiredd' => 'Sie müssen eine E-Mail Adresse angeben!',
            'email.email' => 'Die E-Mail Adresse muss eine valide E-Mail Adresse sein',
            'email.max' => 'Die E-Mail Adresse ist zu lang',
            'startDatum.required' => 'Sie müssen ein Startdatum Ihreres besuches angeben',
            'startDatum.date' => 'Das "Von" Datum muss eine Datum sein',
            'endDatum.required' => 'Sie müssen ein Enddatum Ihreres besuches angeben',
            'endDatum.date' => 'Das "Bis" Datum muss eine Datum sein',
            'number_of_people.required' => 'Sie müssen die Anzahl Gäste angeben',
            'number_of_people.integer' => 'Die Anzahl Gäste muss eine Zahl sein'
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
            'name' => 'required|max:30|min:2',
            'firstname' => 'required|max:30|min:2',
            'email' => 'required|email|max:50',
            'startDatum' => 'required|date',
            'endDatum' => 'required|date',
            'number_of_people' => 'required|integer'
        ];
    }
}
