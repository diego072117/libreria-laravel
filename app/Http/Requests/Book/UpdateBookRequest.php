<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => ['nullable','required'],
            'author_id' => ['nullable','required'],
            'title' => ['required','string'],     
            'stock' => ['required','numeric'],  
            'description' => ['required','string','min:20'],        
        ];
    }

    public function messages(){

        return [
            'category_id.required' => 'La categoria es requerida.',

            'author_id.required' => 'El autor es requerido.',


            'title.required' => 'El titulo es requerido.',
            'title.string' => 'titulo no valido.',

            'stock.required' => 'El stock es requerido.',
            'stock.numeric' => 'stock no valido.',


            'description.required' => 'La description es requerida.',
            'description.string' => 'description no valida.',
            'description.min' => 'La description es muy corta (min 20)',

        ];

    }
}
