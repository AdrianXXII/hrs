<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPostRequest extends FormRequest
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
            'name.required' => 'Sie müssen einen Benutzernamen angeben!',
            'name.max' => 'Der Benutzername ist zu lange!',
            'name.min' => 'Der Benutzername ist zu kurz!',
            'name.unique' => 'Der Benutzername kann nicht gebraucht werden!',
            'firstname.required' => 'Sie müssen einen Vornamen angeben!',
            'firstname.max' => 'Der Vorname ist zu lange!',
            'firstname.min' => 'Der Vorname ist zu kurz!',
            'lastname.required' => 'Sie müssen einen Nachnamen angeben!',
            'lastname.max' => 'Der Name ist zu lange!',
            'lastname.min' => 'Der Name ist zu kurz!',
            'groupId.required' => 'Eine Gruppe muss angegeben werden!',
            'groupId.integer' => 'Elender Häcker!',
            'email.required' => 'Sie müssen eine E-Mail Adresse angeben!',
            'email.unique' => 'Die E-Mail Adresse kann nicht gebraucht werden',
            'email.email' => 'Die E-Mail Adresse muss eine valide E-Mail Adresse sein',
            'email.max' => 'Die E-Mail Adresse ist zu lang',
            'password.required' => 'Sie müssen ein Passwort angeben',
            'password.confirmed' => 'Die Passwörter stimmen nicht überein',
            'password.min' => 'Das Passwort muss mindestens 6 Zeichen lang sein'
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
            'name' => 'required|max:30|unique:users',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|min:6|confirmed',
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'groupId' => 'required|integer'
        ];
    }
}
