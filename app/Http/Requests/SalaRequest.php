<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SalaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'nombre' => 'required','max:100',
            'piso' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' =>'Debe ingresar el nombre de la Sala',
            'nombre.max'=>'El nombre debe tener un tamanio mayor a 100 caracteres',
            'pisos.required' =>'Debe seleccionar el numero de Piso',
        ];
    }
}
