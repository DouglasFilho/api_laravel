<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Requests\UserRequest;

class UserTest extends TestCase
{
    /**
     * Função para testar a criação de um usuario.
     */
    public function test_cria_novo_usuario_teste(): void
    {
      $request = UserRequest::create('/store', 'POST');
      $request->merge([
        "name" => "teste",
        "email" => "teste_email@gmail.com",
        "password" => '123456'
      ]);
       
      (new UserController)->store($request);

      $this->assertEquals(
        User::where('email', 'teste_email@gmail.com')->first()->name,
        'teste'
      );
    }

    /**
     * Função para testar a edição de um usuario.
     */
    public function test_edita_usuario(): void
    {
      $id = User::where('email', 'teste_email@gmail.com')->first()->id;
      $request = UserRequest::create('/update', 'PUT');
      $request->merge([
        "name" => "teste update",
        "email" => "teste_email@gmail.com",
        "password" => '123456'
      ]);
      
      (new UserController)->update($request, $id);

      $this->assertEquals(
        User::where('email', 'teste_email@gmail.com')->first()->name,
        'teste update'
      );
    }

    /**
     * Função para a exclusão de um usuário
     */
    public function test_deleta_usuario(): void
    {
      $id = User::where('email', 'teste_email@gmail.com')->first()->id;
      
      (new UserController)->destroy($id);
      $user = User::where('id', $id)->first();

      $this->assertTrue(
        !$user
      );
    }
}
