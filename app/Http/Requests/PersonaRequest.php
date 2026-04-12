<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombres'=>'required',
            'razon_social'=>'required',
            'nit'=>'required',
            'tipo_persona'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'nombres.required'=>'Debe ingresar el nombre de la persona o nombre empresa',
            'razon_social.required'=>'Debe ingresar la razón social de la persona o empresa',
            'nit.required'=>'Debe indicar el número de NIT',
            'tipo_persona.required'=>'Debe seleccionar el tipo de persona que corresponda'
        ];
    }
}
