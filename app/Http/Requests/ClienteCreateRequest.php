<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteCreateRequest extends FormRequest
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
        'documento' => 'required|min:6|max:13|unique:clientes',
        'nombre' => 'required|min:3|max:20|regex:/^[\pL\s\-]+$/u',
        'apellido' => 'required|min:4|max:50|regex:/^[\pL\s\-]+$/u',
        'direccion' => 'required|min:7|max:50',
        'telefono' => 'required|min:10|max:10|',
        'email'=> 'required|email|unique:clientes',
        'estado' => 'nullable'
        ];
    }
    public function messages()
    {
        return [
        'nombre.required' => 'El campo nombre es requerido',
        'direccion.required' => 'El campo dirección es requerido',
        'telefono.required' => 'El campo celular es requerido',
        'email.required' => 'El campo correo es requerido'

        ];
    }
}
