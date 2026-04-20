<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ContratoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo_contrato'     => 'required|in:Nacional,Internacional',
            'cliente_id'        => 'required|exists:clientes,id',
            'proveedor_id'      => 'required|exists:proveedores,id',
            'fecha_inicio'      => 'nullable|date',
            'fecha_fin'         => 'nullable|date|after_or_equal:fecha_inicio',
            'cantidad_camiones' => 'nullable|integer|min:1',
            'monto_total'       => 'required|numeric|min:0',
            'moneda'            => 'required|in:BOB,USD,EUR,BRL,ARS,PEN,CLP,PYG,COP',
            'estado'            => 'required|in:Borrador,Activo,Finalizado,Cancelado',
        ];
    }

    public function messages(): array
    {
        return [
            'tipo_contrato.required'  => 'El tipo de contrato es obligatorio.',
            'cliente_id.required'     => 'Debe seleccionar un cliente.',
            'cliente_id.exists'       => 'El cliente seleccionado no existe.',
            'proveedor_id.required'   => 'Debe seleccionar un proveedor.',
            'proveedor_id.exists'     => 'El proveedor seleccionado no existe.',
            'fecha_fin.after_or_equal'=> 'La fecha fin debe ser igual o posterior a la fecha inicio.',
            'monto_total.required'    => 'El monto total es obligatorio.',
            'monto_total.numeric'     => 'El monto total debe ser un número.',
            'moneda.required'         => 'La moneda es obligatoria.',
            'estado.required'         => 'El estado es obligatorio.',
        ];
    }
}
