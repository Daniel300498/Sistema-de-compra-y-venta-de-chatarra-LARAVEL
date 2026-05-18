<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;
use RealRashid\SweetAlert\Facades\Alert;

class ChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }
    public function rules()
    {
        return [
            'current_password' => ['required',
            ],
            'new_password' => ['required','string','confirmed','different:current_password',
                Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
            ],
        ];
    }
    public function messages()
    {
        return [
            'current_password.required' => 'Debe ingresar la contraseña actual.',
            'new_password.required' => 'Debe ingresar la nueva contraseña.',
            'new_password.string' => 'La nueva contraseña no es válida.',
            'new_password.confirmed' => 'Las contraseñas no coinciden.',
            'new_password.different' => 'La nueva contraseña no puede ser igual a la contraseña actual.',
            'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'new_password.letters' => 'La nueva contraseña debe contener letras.',
            'new_password.mixed' => 'La nueva contraseña debe contener mayúsculas y minúsculas.',
            'new_password.numbers' => 'La nueva contraseña debe contener al menos un número.',
            'new_password.symbols' => 'La nueva contraseña debe contener al menos un símbolo.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        Alert::error('Error', $validator->errors()->first());
        throw new HttpResponseException(redirect()->back()->withErrors($validator)->withInput()->with('active_tab', 'change_password'));
    }
}