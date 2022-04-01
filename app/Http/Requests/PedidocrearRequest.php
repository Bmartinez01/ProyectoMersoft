<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidocrearRequest extends FormRequest
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


            'cliente' => 'required',
            'cantidad' => 'nullable',
            'producto' => 'nullable',
            'valor_unitario'=> 'nullable',
            'valor_total'=> 'required',
            'estado' => 'required',
            // 'tipo' => 'required'


    ];
    }
}
