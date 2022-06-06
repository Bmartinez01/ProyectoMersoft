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
            'name' =>'required',
            'email' =>['required','not_regex:/^.+$/i','unique:users,email,' . request()->route('user')->id],
            'password' =>'sometimes',
            'estado' => ['nullable'],
            'rol' => 'required'
        ];
    }
}
