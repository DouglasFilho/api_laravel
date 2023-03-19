<?php

namespace App\Http\Requests;

use App\Http\Requests\CustomRulesRequest;

class DespesaRequest extends CustomRulesRequest
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
        "id_usuario"  => "required|exists:users,id",
        "data"        => "required|date_format:Y-m-d|before:today",
        "valor"       => ['required','regex:/^(\d{1,3}(\.\d{3})*|\d+)(,\d{2})?$/'],
        "descricao"   => "required|string|max:191"
      ];
    }   

    public function validateToUpdate() : array
    {
      return [
        "id_usuario"  => "exists:users,id",
        "data"        => "date_format:Y-m-d|before:today",
        "valor"       => ['regex:/^(\d{1,3}(\.\d{3})*|\d+)(,\d{2})?$/'],
        "descricao"   => "string|max:191"
      ];
    }   

    public function messages() :array
    {
      return [
        'required' => 'O campo :attribute é obrigatório!',
        'date_format' => 'O campo :attribute deve ter o formato Y-m-d!',
        'before' => 'O campo :attribute deve ser anterior a hoje!',
        'numeric' => 'O campo :attribute deve ser do tipo numérico!',
        'string' => 'O campo :attribute deve ser do tipo string!',
        'max' => 'O campo :attribute deve ter no máximo 191 caracteres!',
        'exists' => 'O :attribute não existe!',
        'valor.regex' => 'O campo :attribute deve seguir o padrao brasileiro de valor sem siglas e deve ser positivo. Ex: 1.234,56',
      ];
    }
}
