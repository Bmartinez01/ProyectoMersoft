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

            'Nombre' => 'required|min:4|unique:productos',
            'Categorías' => 'required|min:1|max:20',
            'unidad' => 'required',
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
