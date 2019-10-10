<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules  = [
            'name'  => 'required|max:60|unique:products,name,' . $this->product,
        ];

        if ($this->getMethod() == 'PUT') {
            $rules += ['description'     => 'required|max:200'];
            $rules += ['category_id'     => 'required'];
            $rules += ['stock'           => 'required|numeric'];
            $rules += ['sale_price'      => 'required|between:1,999.99|numeric'];
            $rules += ['sku'             => 'required|alpha_num|max:20'];
        }

        return $rules;
    }

    /**
     * Get the messages for the rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'         => 'El nombre es obligatorio.',
            'name.max'              => 'No más de 60 caracateres.',
            'name.unique'           => 'Este nombre ya se ha registrado.',
            'description.required'  => 'La descripción es obligatoria.',
            'description.max'       => 'No más de 160 caracateres.',
            'category_id.required'  => 'La categoría es obligatoria.',
            'stock.required'        => 'El stock es obligatorio',
            'stock.numeric'         => 'stock inválido',
            'sale_price.required'   => 'El precio de venta es obligatorio.',
            'sale_price.numeric'    => 'Precio inválido.',
            'sale_price.between'    => 'El precio debe estar entre 1 y 999.99',
        ];
    }
}
