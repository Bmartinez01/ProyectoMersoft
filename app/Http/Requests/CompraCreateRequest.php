<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompraCreateRequest extends FormRequest
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

                'recibo' => 'required|min:3|max:13|unique:compras',
                'fecha_compra' => 'required|max:10',
                'proveedor' => 'required',
                'cantidad' => 'nullable',
                'producto' => 'nullable',
                'valor_unitario'=> 'nullable',
                'valor_total'=> 'required',
                'estado' => 'nullable'


        ];
    }
}
