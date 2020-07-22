<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RutRequest extends FormRequest
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
            'rut' => 'regex:/^[0-9]{3,8}[-]{1}[0-9kK]{1}$/|unique:users,rut'
        ];
    }
}
