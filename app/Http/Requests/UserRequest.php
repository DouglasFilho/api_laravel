<?php

namespace App\Http\Requests;

use App\Http\Requests\CustomRulesRequest;

class UserRequest extends CustomRulesRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function validateToStore() : array
    {
      return [
        'name'     => 'required',
        'email'    => 'required|email',
        'password' => 'required'
      ];
    }   

    public function validateToUpdate() : array
    {
      return [
        'email'    => 'email',
      ];
    }   

    public function messages(){
      return [
        'required' => 'O campo :attribute é obrigatório!',
        'email' => 'O campo :attribute deve ser um email válido!',
      ];
    }
}
