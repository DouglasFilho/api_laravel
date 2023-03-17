<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DespesaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
        'id'    => $this->id,
        'descricao'   => $this->descricao,
        'data'        => $this->data,
        'id_usuario'  => $this->id_usuario,
        'valor'       => $this->valor
      ];
    }
}
