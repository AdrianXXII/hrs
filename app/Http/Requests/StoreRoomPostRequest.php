<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomPostRequest extends FormRequest
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
            'room_number.required' => 'Sie müssen eine Zimmernummer angeben!',
            'room_number.integer' => 'Sie müssen eine gültige Zimmernummer angeben!',
            'room_type.required' => 'Sie müssen einen Zimmertyp angeben!',
            'room_type.integer' => 'Sie müssen einen gültigen Zimmertyp angeben!'
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
            'room_number' => 'required|integer',
            'room_type' => 'required|integer'
        ];
    }
}
