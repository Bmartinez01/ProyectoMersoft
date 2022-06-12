<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoEditRequest extends FormRequest
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
            //

            'Nombre' => 'required|min:4|max:30|unique:productos',
            'Categorías' => 'required|min:1|max:20',
            'unidad' => 'required',
            'Precio' => 'required',
            'estado' => 'nullable'

        ];
    }
}
