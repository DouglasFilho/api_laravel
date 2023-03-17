<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Despesa;


class DespesaPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function editarDespesa(User $user, Despesa $despesa){
      return $user->id === $despesa->id_usuario;
    }
}
