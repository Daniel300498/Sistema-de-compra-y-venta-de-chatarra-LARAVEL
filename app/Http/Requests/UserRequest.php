<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use RealRashid\SweetAlert\Facades\Alert;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules(Request $request)
    {
        if ($this->method() === 'PUT') {
            $rules = ['name' => 'required','role_id' => 'required','email' => ['required',Rule::unique('users')->ignore($this->route('user')),],];
        } else {
            $rules = [
                'name' => 'required',
                'password' => ['required','confirmed',
                    Password::min(8)->letters()->mixedCase()->numbers()->symbols(),],
                'role_id' => 'required',
                'email' => ['required',Rule::unique('users'),],];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.unique' => 'El correo ingresado ya fue utilizado.',
            'role_id.required' => 'Debe asignar un rol al usuario.',
        ];
    }
   protected function failedValidation(Validator $validator)
    {
        Alert::error('Error', $validator->errors()->first());
        throw new HttpResponseException(redirect()->back()->withErrors($validator)->withInput()->with('active_tab', 'change_password'));
    }
}