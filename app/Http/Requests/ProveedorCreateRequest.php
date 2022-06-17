<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorCreateRequest extends FormRequest
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

        'nit_empresa' => 'required|min:3|max:13|unique:proveedores',
        'nombre' => 'required|min:3|max:20|regex:/^[\pL\s\-]+$/u',
        'apellido' => 'required|min:4|max:50|regex:/^[\pL\s\-]+$/u',
        'empresa' => 'required|min:3|max:50',
        'categoria_id' => 'required',
        'direccion' => 'required|min:7|max:50',
        'telefono' => 'required|min:10|max:10',
        'email'=> 'required|email|unique:proveedores',
        'estado' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
        'categoria_id.required' => 'El campo categoría es requerido',
        'email.required' => 'El campo correo es requerido',
        'direccion.required' => 'El campo dirección es requerido',
        'telefono.required' => 'El campo teléfono es requerido',

        ];
    }
}
