<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\User;


class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Grupo::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Grupo::create($request->all());
    }
    /**
     * Associar um usuario a um grupo
     */
    public function agroup(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user::where('id', $id)->update(['grupo_id' => $request->idGrupo]);
        return ['msg'=>'atualizado'];
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Grupo::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $grupo = Grupo::findOrFail($id);
        return $grupo->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Grupo::destroy($id);
    }
    public function listaFuncGrupo(string $id)
    {
         $grupo = Grupo::findOrFail($id);
         if($grupo){
             $response = [
                 'funcionalidade'=>$grupo->funcionalidade
             ];
         }
        return $response;
    }
}
