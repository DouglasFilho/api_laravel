<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Http\Resources\UserResource;

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
        'id'          => $this->id,
        'descricao'   => $this->descricao,
        'data'        => $this->data,
        'usuario'     => new UserResource(User::findOrFail($this->id_usuario)),
        'valor'       => $this->valor
      ];
    }
}
