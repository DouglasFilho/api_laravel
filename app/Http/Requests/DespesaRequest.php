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
        "data"        => "required|date_format:Y-m-d|before:tomorrow",
        "valor"       => "required|numeric|gt:0",
        "descricao"   => "required|string|max:191"
      ];
    }   

    public function validateToUpdate() : array
    {
      return [
        "id_usuario"  => "exists:users,id",
        "data"        => "date_format:Y-m-d|before:tomorrow",
        "valor"       => "numeric|gt:0",
        "descricao"   => "string|max:191"
      ];
    }   
}
