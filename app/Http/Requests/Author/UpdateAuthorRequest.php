<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthorRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
     {
         return [
             'name' => ['required','string'],
             'biography' => ['required','string','min:20'],      
         ];
     }

     public function messages(){

        return [
            'name.required' => 'el nombre es requerido.',
            'name.string' => 'nombre no valido.',

            'biography.required' => 'La biogradia es requerida.',
            'biography.string' => 'biografia no valida',
            'biography.min' => 'demaciado corta (min 20)',

        ];

    }
}
