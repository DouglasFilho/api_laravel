<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Despesa;
use Illuminate\Auth\Access\Response;


class DespesaPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function editarDespesa(User $user, Despesa $despesa)
    {
      return $despesa->id_usuario === $user->id 
                 ? Response::allow() 
                 : Response::deny('Essa despesa não pertence a esse usuário!');
    }
}
