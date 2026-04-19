<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OperadorTransporteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $operadorId = $this->route('operador')?->id;

        $rules = [
            'nombre'             => 'required|string|max:150',
            'apellido'           => 'required|string|max:150',
            'ci'                 => ['required', 'string', 'max:20',
                Rule::unique('operadores_transporte')->ignore($operadorId)->whereNull('deleted_at')
            ],
            'telefono'           => 'nullable|string|max:20',
            'email'              => ['nullable', 'email', 'max:150',
                Rule::unique('operadores_transporte')->ignore($operadorId)->whereNull('deleted_at')
            ],
            'direccion'          => 'nullable|string|max:255',
            'tipo_operador'      => 'required|in:propietario,chofer,ambos',
            'licencia_numero'    => 'nullable|string|max:30',
            'licencia_categoria' => 'nullable|in:A,B,C,D,E,F,G',
            'licencia_vencimiento' => 'nullable|date',
            'estado'             => 'required|in:Activo,Inactivo',
        ];

        // Si es chofer o ambos, licencia es obligatoria
        if (in_array($this->input('tipo_operador'), ['chofer', 'ambos'])) {
            $rules['licencia_numero']    = 'required|string|max:30';
            $rules['licencia_categoria'] = 'required|in:A,B,C,D,E,F,G';
            $rules['licencia_vencimiento'] = 'required|date';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nombre.required'              => 'El nombre es obligatorio.',
            'apellido.required'            => 'El apellido es obligatorio.',
            'ci.required'                  => 'La cédula es obligatoria.',
            'ci.unique'                    => 'Esta cédula ya está registrada.',
            'tipo_operador.required'       => 'El tipo de operador es obligatorio.',
            'licencia_numero.required'     => 'El número de licencia es obligatorio para choferes.',
            'licencia_categoria.required'  => 'La categoría de licencia es obligatoria para choferes.',
            'licencia_vencimiento.required'=> 'La fecha de vencimiento de licencia es obligatoria para choferes.',
        ];
    }
}
