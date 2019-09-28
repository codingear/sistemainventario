<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $categoryId = isset($this->category) ? $this->category : null;
        //dd($categoryId);

        return [
            'name'          => 'required|max:60|unique:categories,name,' . $this->category,
            'description'   => 'max:160',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'         => 'El nombre es obligatorio.',
            'name.max'              => 'No más de 60 caracateres.',
            'name.unique'           => 'Ésta categoría ya se ha registrado.',
            'description.required'  => 'La descripción es obligatorio.',
            'description.max'       => 'No más de 60 caracateres.',
        ];
    }
}