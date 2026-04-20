<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
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
            'nombre'=>'required',
            'pais'=>'required',
            'nit'=>[
                'required',
                'numeric',
                Rule::unique('clientes')->ignore( $this->route('cliente') )->where('deleted_at',null)
            ],
            'email'=>'required'    
        ];
    }
}
