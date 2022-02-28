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
        $proveedor = $this->route('proveedor');
        return [
            //
            //'nombre' => ['required','min:4','max:20','unique:categorias,nombre,' . request()->route('categoria')->id]



        ];
    }
}
