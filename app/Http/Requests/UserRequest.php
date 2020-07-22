<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rut' => 'required|regex:/^[0-9]{3,8}[-]{1}[0-9kK]{1}$/|unique:users,rut',
            'names' => 'required',
            'father_surname' => 'required',
            'email' => 'required|email|unique:users,email',
            'date_birth' => 'required|date',
            'password' => 'required|min:8',
            'picture' => 'sometimes|mimes:jpeg|dimensions:max_width=200,max_height=200'
        ];
    }

    /**
     * Get the custom messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'picture.dimensions' => 'El campo foto debe tener dimensiones máximas de 200x200 px.'
        ];
    }
}
