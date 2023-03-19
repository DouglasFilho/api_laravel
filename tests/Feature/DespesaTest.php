<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Despesa;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\LoginController;
use App\Http\Requests\UserRequest;
use App\Http\Requests\DespesaRequest;
use App\Http\Requests\LoginRequest;

class DespesaTest extends TestCase
{
    /**
     * Função para testar a criação de um novo usuario.
     */
    public function cria_novo_usuario_teste()
    {
      $request = UserRequest::create('/store', 'POST');
      $request->merge([
        "name" => "teste_despesa",
        "email" => "teste_despesa@gmail.com",
        "password" => '123456'
      ]);
       
      (new UserController)->store($request);
      return User::where('email', 'teste_despesa@gmail.com')->first();
    }

    /**
     * Função de login com o usuario criado.
     */
    public function loga_novo_usuario()
    {
      // Login com novo usuario para obter o token
      $request = LoginRequest::create('/login', 'POST');
      $request->merge([
        "email" => "teste_despesa@gmail.com",
        "password" => '123456'
      ]);
       
      $login = (new LoginController)->login($request);

      return json_decode($login->getContent(), true);
    }


    /**
     * Função para testar a criação de uma nova despesa.
     */
    public function test_cria_nova_despesa(): void
    {
      $user = $this->cria_novo_usuario_teste();
      $data = $this->loga_novo_usuario();

      $requestDespesa = DespesaRequest::create('/store', 'POST', ['Authorization' => 'Bearer '.$data['token']]);
      $requestDespesa->merge([
        "descricao"  => "despesas de teste",
        "data"       => Carbon::yesterday()->setTime(12, 30, 0)->setTimezone('America/Sao_Paulo'),
        "id_usuario" => $user->id,
        "valor"      => "23.000,50"
      ]);
      
      (new DespesaController)->store($requestDespesa);

      $this->assertEquals(
        Despesa::where('id_usuario', $user->id)->first()->descricao,
        'despesas de teste'
      );
    }

    /**
     * Função para testar a editar de uma nova despesa.
     */
    public function test_edita_nova_despesa(): void
    {
      $user = User::where('email', 'teste_despesa@gmail.com')->first();
      $data = $this->loga_novo_usuario();

      $requestDespesa = DespesaRequest::create('/update', 'PUT', ['Authorization' => 'Bearer '.$data['token']]);
      $requestDespesa->merge([
        "descricao"  => "despesas de teste update",
        "data"       => Carbon::yesterday()->setTime(12, 30, 0)->setTimezone('America/Sao_Paulo'),
        "id_usuario" => $user->id,
        "valor"      => "23.000,50"
      ]);
      
      $id = Despesa::where('id_usuario', $user->id)->first()->id;
      (new DespesaController)->update($requestDespesa, $id);

      $this->assertEquals(
        Despesa::where('id_usuario', $user->id)->first()->descricao,
        'despesas de teste update'
      );
    }

    /**
     * Função para testar a exlclusão de uma nova despesa.
     */
    public function test_deleta_nova_despesa(): void
    {
      $user = User::where('email', 'teste_despesa@gmail.com')->first();
      $data = $this->loga_novo_usuario();
      $despesa = Despesa::where('id_usuario', $user->id)->first();

      (new DespesaController)->destroy($despesa->id);
      (new UserController)->destroy($user->id);
      $despesa = Despesa::where('id_usuario', $user->id)->first();

      $this->assertTrue(
        !$despesa
      );
    }
}
