<?php
namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
class CuentaBancariaRequest extends FormRequest
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
            'banco' => 'required|string|max:100',
            'titular' => 'required|max:100',    
            'numero_cuenta' => [
                'required',
                'numeric',
                Rule::unique('cuentas_bancarias', 'numero_cuenta')->ignore(optional($this->route('cuentas_bancarias'))->id)->whereNull('deleted_at')
            ]
        ];
    }
}
