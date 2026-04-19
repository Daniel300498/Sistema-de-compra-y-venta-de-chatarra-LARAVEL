<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CamionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'placa'         => ['required', 'string', 'max:20',
                Rule::unique('camiones')->ignore($this->route('camion'))->whereNull('deleted_at')
            ],
            'tipo_vehiculo' => 'required|string|max:100',
            'marca'         => 'required|string|max:100',
            'modelo'        => 'required|string|max:100',
            'anio'          => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'capacidad_kg'  => 'required|numeric|min:0',
            'color'          => 'nullable|string|max:50',
            'estado'         => 'required|in:Activo,Inactivo,En mantenimiento',
            'propietario_id' => 'nullable|exists:operadores_transporte,id',
        ];
    }

    public function messages(): array
    {
        return [
            'placa.required'        => 'La placa es obligatoria.',
            'placa.unique'          => 'Esta placa ya está registrada.',
            'tipo_vehiculo.required'=> 'El tipo de vehículo es obligatorio.',
            'marca.required'        => 'La marca es obligatoria.',
            'modelo.required'       => 'El modelo es obligatorio.',
            'anio.required'         => 'El año es obligatorio.',
            'anio.min'              => 'El año no es válido.',
            'capacidad_kg.required' => 'La capacidad en kg es obligatoria.',
            'capacidad_kg.numeric'  => 'La capacidad debe ser un número.',
            'estado.required'       => 'El estado es obligatorio.',
        ];
    }
}
