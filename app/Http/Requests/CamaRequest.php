<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CamaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'numero' => ['required',Rule::unique('camas')->ignore( $this->route('cama') )],
            'estado' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'numero.required' =>'Debe ingresar el numero de la cama',
            'numero.unique'=>'El numero de cama ya esta registrado',
            'estado.required' => 'Debe ingresar una descripcion',
        ];
    }
}
