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
            'title'     => 'required|max:20',
            'text_alt'  => 'max:20'
        ];
    }

    public function messages()
    {
        return [
            'title.required'        => 'El título es requerido.',
            'title.max'             => 'No más de 20 caracteres.',
            'text_alt.max'          => 'No más de 20 caracteres.',
        ];
    }
}
