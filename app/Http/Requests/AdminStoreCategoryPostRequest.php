<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreCategoryPostRequest extends FormRequest
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
            'name.required' => 'Sie müssen einen Kategoriebezeichnung angeben!',
            'description.required' => 'Sie müssen einen Beschreibung angeben!',
            'number_of_beds.required' => 'Sie müssen die Anzahl Betten angeben!',
            'number_of_beds.integer' => 'Die Anzahl Betten muss eine Zahl sein',
            'number_of_beds.min' => 'Anzahl Betten muss mindestens 1 betragen'
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
        ];
    }
}
