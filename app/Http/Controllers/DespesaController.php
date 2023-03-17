<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Despesa;
use App\Http\Resources\DespesaResource;
use App\Http\Requests\DespesaRequest;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return DespesaResource::collection(Despesa::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DespesaRequest $request)
    {
      Despesa::create($request->all());
      return response()->json([ 'message' => 'Despesa cadastrada com sucesso!'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      return new DespesaResource(Despesa::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DespesaRequest $request, string $id)
    {
      $despesa = Despesa::where('id', $id)->first();
    
      if(!$despesa)
        return response()->json([ 'message' => 'Despesa não existente!']);
      
      $this->authorize('editarDespesa', $despesa);

      $despesa->update($request->all());
      return response()->json([ 'message' => 'Despesa atualizada com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $despesa = Despesa::where('id', $id)->first();
      if(!$despesa)
        return response()->json([ 'message' => 'Despesa não existente!']);

      $this->authorize('editarDespesa', $despesa);

      $despesa->delete();
      return response()->json([ 'message' => 'Despesa deletada com sucesso!']);
    }
}
