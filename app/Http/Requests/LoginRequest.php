<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //colocar policies aqui
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages(): array
    {
      return [
        'required' => 'O campo :attribute é obrigatório!',
        'email' => 'O campo :attribute deve ser um email válido!',
      ];
    }
}
