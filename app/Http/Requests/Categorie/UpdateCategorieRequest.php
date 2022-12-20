<?php

namespace App\Http\Requests\Categorie;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategorieRequest extends FormRequest
{
 
    public function authorize()
    {
        return true;
    }

 
    public function rules()
    {
        return [
            'name' => ['required','string'],

        ];
    }

    public function messages(){

       return [
           'name.required' => 'el nombre es requerido.',
           'name.string' => 'nombre no valido.',

       ];

}
}
