<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'productImage' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'productImage.image'       => 'Solo se admiten imagenes .jpg, .png o .jpeg',
            'productImage.max'         => 'La imagen debe ser menor a 2mb',
            'productImage.mimes'       => 'Solo se admiten imagenes .jpg, .png o .jpeg',
        ];
    }
}
