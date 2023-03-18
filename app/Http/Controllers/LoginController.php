<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
      
      $credentials = $request->only('email', 'password');

      if(!auth()->attempt($credentials)) 
        return response()->json('Credenciais invalidas', 401);

      $token = auth()->user()->createToken('JTW');
      return response()->json(["token" => $token->plainTextToken], 202);
    }

}
