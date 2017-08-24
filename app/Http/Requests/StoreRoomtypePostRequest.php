<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomtypePostRequest extends FormRequest
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
            'name.required' => 'Sie müssen einen Namen angeben!',
            'description.required' => 'Sie müssen einen Beschreibung angeben!',
            'number_of_beds.required' => 'Sie müssen die Anzahl Zimmer angeben!',
            'number_of_beds.integer' => 'Die Anzahl Zimmer muss eine Zahl sein!',
            'number_of_beds.min' => 'Die Anzahl Zimmer muss mindestens 1 sein!',
            'category.required' => 'Sie müssen eine Kategorie angeben!',
            'category.integer' => 'Sie müssen eine gültige Kategorie angeben!',
            'price.required' => 'Sie müssen einen Preis eingeben!',
            'price.numeric' => 'Sie müssen einen gültigen Preis eingeben!',
            'price.min' => 'Sie müssen einen gültigen Preis eingeben!',
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
            'number_of_beds' => 'required|integer|min:1',
            'category' => 'required|integer',
            'price' => 'required|numeric|min:0'
        ];
    }
}
