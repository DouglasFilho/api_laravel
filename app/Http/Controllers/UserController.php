<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $user = User::where('email', $request->email)->first();

      if($user)
        return response()->json([ 'message' => 'Email ja cadastrado']);

      $userData = $request->only('name', 'email', 'password');
      $userData['password'] = bcrypt($userData['password']);
      
      User::create($userData);
      
      return response()->json([ 'message' => 'Usuário cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
      return new UserResource(User::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {      
      $user = User::where('id', $id)->first();
      if(!$user)
        return response()->json([ 'message' => 'Usuário não existente!']);

      if($request->name)
        $user->name = $request->name;

      if($request->email)
        $user->email = $request->email;

      if($request->password)
        $user->password = bcrypt($request->password);
      
      $user->save();
      return response()->json([ 'message' => 'Usuário atualizado com sucesso!']);
    }
}
