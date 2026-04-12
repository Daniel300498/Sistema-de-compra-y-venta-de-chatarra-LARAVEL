<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ConsultaRequest extends FormRequest
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
                'medico_id'=>'required',
                'motivo_consulta'=>'required',
                'diagnostico'=>'required',
                'fecha'=>'required'];
            return $rules;
        }else{
            return [
                'medico_id'=>'required',
                'motivo_consulta'=>'required',
                'diagnostico'=>'required',
                'fecha'=>'required'
            ];
        }  
    }
}
