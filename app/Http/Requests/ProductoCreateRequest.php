<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoCreateRequest extends FormRequest
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
            'Código' => 'required|min:1|max:20|unique:productos',
            'Nombre' => 'required|min:4|max:20',
            'Categorías' => 'required|min:1|max:20',
            'Stock' => 'required|min:1|max:20',
            'Precio' => 'required|min:1|max:20',
            'estado' => 'nullable'


        ];
    }

    /* public function messages()
    {
        return [
        'nombre.required' => 'El nombre es requerido'
        ]
    } */
}
