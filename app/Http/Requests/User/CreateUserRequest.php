<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required','string'],
            'last_name' => ['required','string'],
            'number_id' => ['required','numeric','unique:users,number_id'],     
            'email' => ['required','email','unique:users,email'],  
            'password' => ['required','string','min:8','confirmed'],        
        ];
    }

    public function messages(){

        return [
            'name.required' => 'el nombre es requerido.',
            'name.string' => 'nombre no valido.',

            'last_name.required' => 'el apellido es requerido.',
            'last_name.string' => 'apellido no valido.',

            'number_id.required' => 'El documento es requerido.',
            'number_id.numeric' => 'numero no valido.',
            'number_id.unique' => 'El documento ya existe',

            'email.required' => 'El correo es requerido.',
            'email.email' => 'correo no valido.',
            'email.unique' => 'El correo ya existe.',


            'password.required' => 'La contraseña es requerida.',
            'password.string' => 'contraseña no valida.',
            'password.min' => 'La contraseña es muy corta (min 8)',
            'password.confirmed' => 'La contraseña no coincide.',

        ];

    }
}
