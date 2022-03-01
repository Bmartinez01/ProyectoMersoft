<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorEditRequest extends FormRequest
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
        'nit_empresa' => ['required','min:3','max:13','unique:proveedores,nit_empresa,'. request()->route('proveedore')->id],    
        'nombre' => ['required','min:3','max:20'],
        'apellido' => ['required','min:4','max:50'],
        'empresa' => ['required','min:4','max:50'],
        'categoria_id' => ['required'],
        'direccion' => ['required','min:7','max:50'],
        'telefono' => ['required','min:4','max:20'],
        'email'=> ['required','unique:proveedores,email,' . request()->route('proveedore')->id],
        'estado' => ['nullable']   
        ];

        
    }
}
