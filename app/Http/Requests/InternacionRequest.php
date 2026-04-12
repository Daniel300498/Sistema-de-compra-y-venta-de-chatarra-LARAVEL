<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class InternacionRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        if ($this->_method === 'PUT') {
            $rules =[
                'cama_id'=>'required',
                'medico_id'=>'required',
                'fecha_ocupacion'=>'required',
                'motivo'=>'required',
                ];
            return $rules;
        }else{
            return [
                'cama_id'=>'required',
                'medico_id'=>'required',
                'fecha_ocupacion'=>'required',
                'motivo'=>'required',
            ];
        }  
    }
}
