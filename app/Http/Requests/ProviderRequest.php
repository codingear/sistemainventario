<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
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
            'name'          => 'required|max:120|unique:providers,name,' . $this->provider,
            'contact_name'  => 'required|max:60',
            'email'         => 'required|email|unique:providers,email,' . $this->provider,
            'rfc'           => 'required|max:13|unique:providers,rfc,' . $this->provider,
            'address'       => 'required',
            'state_id'      => 'required',
            'city'          => 'required|max:60',
            'zip_code'      => 'required|digits_between:5,8|numeric',
            'telephone'     => 'required|digits_between:10,13|numeric'
        ];
    }


    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'             => 'El nombre es requerido',
            'name.max'                  => 'No más de 120 caracateres',
            'name.unique'               => 'Este nombre ya se ha registrado',
            'contact_name.required'     => 'El nombre de contacto es requerido',
            'email.email'               => 'El email tiene formato incorrecto',
            'email.required'            => 'El email es requerido',
            'email.unique'              => 'Este email ya se ha registrado',
            'rfc.required'              => 'El RFC es requerido',
            'rfc.max'                   => 'No más de 13 caracateres',
            'rfc.unique'                => 'Este RFC ya se ha registrado',
            'address.required'          => 'La direeción es requerida',
            'state_id.required'         => 'El estado es requerido',
            'city.required'             => 'La ciudad es requerida',
            'city.max'                  => 'No más de 60 caracateres',
            'zip_code.required'         => 'El código Postal es requerido',
            'zip_code.digits_between'   => 'El código postal debe contener entre 5 y 8 dígitos',
            'zip_code.numeric'          => 'Solo números',
            'telephone.required'        => 'El teléfono es requerido',
            'telephone.digits_between'  => 'El teléfono debe contener entre 10 y 13 dígitos',
            'telephone.numeric'         => 'Solo números',
        ];
    }
}
