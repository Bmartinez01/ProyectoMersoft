<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoEditRequest extends FormRequest
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
            // 'cliente' => 'required',
            'cantidad' => 'nullable',
            'producto' => 'nullable',
            'valor_unitario'=> 'nullable',
            'valor_total'=> 'required|min:3',
            'estado' => 'required',
        ];
    }
    public function messages()
    {
        return [
        'valor_total.min' => 'Este campo debe contener un valor mayor a 0'
        ];
    }
}
