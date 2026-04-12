<?php
namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {

        if ($this->method() === 'PUT') { //update
            $rules = [
                'name' => 'required',
                'role_id' => 'required',
                'email' => ['required', Rule::unique('users')->ignore($this->route('user')), 
                ],
            ];
        }
        else {
            $rules = [ // create
                'name' => 'required',
                'password' => 'required||min:7',
                'password_confirm'=> 'required||same:password',
                'role_id' => 'required',
                'email' => [
                    'required',
                    Rule::unique('users'), 
                ],
            ];
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El campo es de ingreso obligatorio.',
            'email.required' => 'El campo es de ingreso obligatorio.',
            'email.unique' => 'El correo ingresado ya fue utilizado.',
            'password.required' => 'Debe ingresar una contrase���a.',
            'password.min' => 'La contrase���a debe tener 7 caracteres como m���nimo',
            'role_id.required' => 'Debe asignar un rol al usuario.',
            'empleado_id.required' => 'Debe seleccionar un empleado',
            'password_confirm.same' => 'Las Contrase���as no coinciden',
            'password_confirm.required' => 'Debe confirmar la contrase���a',

        ];
    }
}
