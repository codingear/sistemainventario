<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdministratorUpdateProfile extends FormRequest
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
        return [
            'name'      => 'required|max:60',
            'email'     => 'required|email|max:255|unique:users,email,' . $userId . ',id',
            'password'  => 'required|string|min:6|confirmed'
        ];
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
            'rol.required'           => 'El rol es obligatorio.'
        ];
    }
}
