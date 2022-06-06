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
            'name' =>'required|min:5|max:40',
            'email'=>'required|email|unique:users|not_regex:/^.+$/i',
            'password'=>'required|confirmed|min:8|max:20',
            'estado' => 'nullable',
            'rol' => 'required'
        ];
    }
}
