<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationStoreRequest extends FormRequest
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
            'name.required' => 'Sie müssen den Kundennamen angeben',
            'name.max' => 'Der Kundenname darf nicht länger als 30 Zeichen sein',
            'name.min' => 'Der Kundenname darf nicht kürzer als 2 Zeichen sein',
            'firstname.required' => 'Sie müssen den Vornamen angeben',
            'firstname.max' => 'Der Vorname darf nicht länger als 30 Zeichen sein',
            'firstname.min' => 'DEr Vorname darf nicht kürzer als 2 Zeichen sein',
            'email.requiredd' => 'Sie müssen eine E-Mail Adresse angeben!',
            'email.email' => 'Die E-Mail Adresse muss eine valide E-Mail Adresse sein',
            'email.max' => 'Die E-Mail Adresse ist zu lang',
            'telephone.required' => 'Die Telefonnummer fehlt!',
            'telephone.max' => 'Die Telefonnummer ist zu lang',
            'startDatum.required' => 'Sie müssen das Startdatum des besuches angeben',
            'startDatum.date' => 'Das "Anreisedatum" Datum muss eine Datum sein',
            'endDatum.required' => 'Sie müssen das Enddatum des besuches angeben',
            'endDatum.date' => 'Das "Abreisedatum" Datum muss eine Datum sein',
            'number_of_people.required' => 'Sie müssen die Anzahl Gäste angeben',
            'number_of_people.integer' => 'Die Anzahl Gäste muss eine Zahl sein',
            'roomtypeId.required' => 'Die Zimmerart fehlt',
            'roomtypeId.integer' => 'Die Zimmerart muss eine Zahl sein',
            'roomId.required' => 'Die Zimmer fehlt',
            'roomId.integer' => 'Die Zimmer muss ein Zahl',
            'status.required' => 'Der Status fehlt',
            'status.digits_between' => 'Der Status ist nicht gültig',
            'price.required' => 'Der Preis fehlt',
            'price.numeric' => 'Der Preis muss eine Zahl sein',

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
            'name' => 'required|max:30|min:2',
            'firstname' => 'required|max:30|min:2',
            'telephone' => 'required|max:30',
            'email' => 'required|email|max:50',
            'number_of_people' => 'required|integer',
            'price' => 'required|numeric',
            'roomtypeId' => 'required|integer',
            'roomId' => 'required|integer'
        ];
    }
}
