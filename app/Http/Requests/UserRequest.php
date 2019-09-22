<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

        $userId = isset($this->user) ? $this->user->id : null;

        $rules = [
            'name'   => 'required|max:60',
            'email'  => 'required|email|max:255|unique:users,email,' . $userId . ',id',
            'rol'    => 'required'
        ];


        if ($this->getMethod() == 'POST') {
            $rules += ['password' => 'required|string|min:8|confirmed'];
        }

        return $rules;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'             => 'El nombre es obligatorio.',
            'name.max'                  => 'No más de 60 caracateres.',
            'email.required'            => 'El email es obligatorio.',
            'email.unique'              => 'Este email ya se ha registrado.',
            'password.required'         => 'La contraseña es obligatoria.',
            'password.confirmed'        => 'La contraseña no coincide.',
            'username.unique'           => 'Este usuario ya se ha registrado.',
            'rol.required'           => 'El rol es obligatorio.'
        ];
    }
}
