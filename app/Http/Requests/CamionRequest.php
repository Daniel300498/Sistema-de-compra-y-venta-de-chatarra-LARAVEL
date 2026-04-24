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
            'placa_pais'    => 'required|string|max:100',
            'placa'         => ['required', 'string', 'max:15',
                Rule::unique('camiones')->ignore($this->route('camion'))->whereNull('deleted_at')
            ],
            'tipo_vehiculo' => ['required', Rule::in(['Camión','Volqueta','Trailer','Furgón'])],
            'marca'         => ['required', Rule::in([
                'Volvo','Scania','Mercedes-Benz','Man','DAF','Iveco',
                'Freightliner','Kenworth','Peterbilt','International',
                'Ford','Chevrolet','Toyota','Hino','Isuzu',
                'Faw','Sinotruk','Foton','Shacman','Dongfeng',
            ])],
            'modelo'        => 'required|string|max:50',
            'anio'          => 'required|integer|min:1970|max:' . date('Y'),
            'capacidad_tn'  => 'required|numeric|min:3.5|max:35',
            'color'         => 'nullable|string|max:30',
            'estado'        => 'required|in:Activo,Inactivo,En mantenimiento',
            'propietario_id'  => 'required|exists:operadores_transporte,id',
            'documento_ruat'  => 'nullable|file|mimes:pdf|max:5120',
            'fotos'           => 'nullable|array|max:5',
            'fotos.*'         => 'file|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }

    public function messages(): array
    {
        return [
            'placa_pais.required'    => 'El país de la placa es obligatorio.',
            'placa.required'         => 'La placa es obligatoria.',
            'placa.unique'           => 'Esta placa ya está registrada.',
            'tipo_vehiculo.required' => 'El tipo de vehículo es obligatorio.',
            'tipo_vehiculo.in'       => 'El tipo de vehículo no es válido.',
            'marca.required'         => 'La marca es obligatoria.',
            'marca.in'               => 'Seleccione una marca válida de la lista.',
            'modelo.required'        => 'El modelo es obligatorio.',
            'anio.required'          => 'El año es obligatorio.',
            'anio.min'               => 'El año mínimo permitido es 1970.',
            'anio.max'               => 'El año no puede ser mayor a ' . date('Y') . '.',
            'capacidad_tn.required'  => 'La capacidad es obligatoria.',
            'capacidad_tn.min'       => 'La capacidad mínima es 3.5 toneladas.',
            'capacidad_tn.max'       => 'La capacidad máxima es 35 toneladas.',
            'propietario_id.required' => 'El propietario es obligatorio.',
            'propietario_id.exists'   => 'El propietario seleccionado no existe.',
            'estado.required'         => 'El estado es obligatorio.',
            'documento_ruat.mimes'    => 'El RUAT debe ser un archivo PDF.',
            'documento_ruat.max'      => 'El RUAT no puede superar los 5 MB.',
            'fotos.max'               => 'Se permiten máximo 5 fotos.',
            'fotos.*.mimes'           => 'Las fotos deben ser JPG, PNG o WEBP.',
            'fotos.*.max'             => 'Cada foto no puede superar los 4 MB.',
        ];
    }
}
