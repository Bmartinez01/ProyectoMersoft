<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'email' =>['required','unique:users,email,' . request()->route('user')->id],
            'password' =>'sometimes',
            'telefono'=>'required|min:10|max:10',
            'direccion'=>'required|min:7|max:50',
            'estado' => ['nullable'],

        ];
    }
}
