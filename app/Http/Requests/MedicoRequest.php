<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MedicoRequest extends FormRequest
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
            'especialidad'=>'required',
            'correo' => [
                    'required',
                    'email',
                    Rule::unique('medicos')->ignore( $this->route('medico') )->where('deleted_at',null)
                ],
            'telefono'=>'required|numeric',     
        ];
    }
}
