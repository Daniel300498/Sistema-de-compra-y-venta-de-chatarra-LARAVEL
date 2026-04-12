<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacacionRequest extends FormRequest
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
            'fecha_solicitud'=>'required',
            'fecha_inicio'=>'required',
            'fecha_hasta'=>'required',
            'jornada_laboral'=>'required',

        ];
    }
}
