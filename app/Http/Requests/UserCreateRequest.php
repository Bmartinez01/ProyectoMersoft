<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' =>'required|min:5|max:40|regex:/^[\pL\s\-]+$/u',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|min:8|max:20',
            'telefono'=>'required|min:10|max:10',
            'direccion'=>'required|min:7|max:50',
            'estado' => 'nullable',

        ];
    }
    public function messages()
    {
        return [
        'name.required' => 'El campo nombre es requerido',
        'name.min' => 'El campo nombre debe tener al menos 5 caracteres',
        'name.regex' => 'El campo nombre solo puede contener letras',
        'email.required' => 'El campo correo es requerido',
        'email.unique' => 'El campo correo ya esta registrado',
        'direccion.required' => 'El campo dirección es requerido',
        'direccion.max' => 'El campo dirección debe ser menos a 50 caracteres',
        'direccion.min' => 'El campo dirección debe ser mayor a 7 caracteres',
        'password.required' => 'El campo contraseña es requerido',
        'password.confirmed' => 'el campo de confirmacion de contraseña no coincide',
        'password.min' => 'El campo contraseña debe ser mayor a 8 caracteres',
        'password.max' => 'El campo contraseña debe ser menos a 20 caracteres',
        'telefono.required' => 'El campo teléfono es requerido'

        ];
    }
}
