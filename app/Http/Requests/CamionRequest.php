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
            'placa' => ['required', 'string', 'max:10',
                'regex:/^[0-9]{4}-[A-Z]{3}$/',
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
            'capacidad_kg'  => 'required|numeric|min:10|max:50000|regex:/^\d+(\.\d{1,3})?$/',
            'color'         => 'nullable|string|max:30',
            'estado'        => 'required|in:Activo,Inactivo,En mantenimiento',
            'propietario_id'=> 'nullable|exists:operadores_transporte,id',
        ];
    }

    public function messages(): array
    {
        return [
            'placa.required'         => 'La placa es obligatoria.',
            'placa.unique'           => 'Esta placa ya está registrada.',
            'placa.regex'            => 'La placa debe tener el formato boliviano: 4 dígitos, guion y 3 letras (ej: 2345-ABC).',
            'tipo_vehiculo.required' => 'El tipo de vehículo es obligatorio.',
            'tipo_vehiculo.in'       => 'El tipo de vehículo no es válido.',
            'marca.required'         => 'La marca es obligatoria.',
            'marca.in'               => 'Seleccione una marca válida de la lista.',
            'modelo.required'        => 'El modelo es obligatorio.',
            'anio.required'          => 'El año es obligatorio.',
            'anio.min'               => 'El año mínimo permitido es 1970.',
            'anio.max'               => 'El año no puede ser mayor a ' . date('Y') . '.',
            'capacidad_kg.required'  => 'La capacidad en kg es obligatoria.',
            'capacidad_kg.min'       => 'La capacidad mínima es 10 kg.',
            'capacidad_kg.max'       => 'La capacidad máxima es 50,000 kg.',
            'capacidad_kg.regex'     => 'La capacidad permite máximo 3 decimales separados por punto.',
            'estado.required'        => 'El estado es obligatorio.',
        ];
    }
}
