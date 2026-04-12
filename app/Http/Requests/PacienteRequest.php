<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
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
            'ap_paterno'=>'required',
            'nombres'=>'required',
            'fecha_nacimiento'=>'required',
            'sexo'=>'required',
            'ci'=>[
                'required',
                'numeric',
                Rule::unique('pacientes')->ignore( $this->route('paciente') )->where('deleted_at',null)
            ],
            'ci_lugar'=>'required',
            'domicilio'=>'required',
            'email' => [
                'required',
                'email',
                Rule::unique('pacientes')->ignore( $this->route('paciente') )->where('deleted_at',null)
            ],
            'nro_celular'=>'required|numeric',
            'contacto_nombre'=>'required',
            'contacto_telefono'=>'required|numeric',
            'contacto_parentesco'=>'required',            
        ];
    }
}
