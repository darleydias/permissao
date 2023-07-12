<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\User;


class GrupoController extends Controller
{
    /*** CRUD ***/
    public function index()
    {
        return Grupo::all();
    }
    public function store(Request $request)
    {
        return Grupo::create($request->all());
    }
    public function show(string $id)
    {
        return Grupo::findOrFail($id);
    }
    public function update(Request $request, string $id)
    {
        $grupo = Grupo::findOrFail($id);
        return $grupo->update($request->all());
    }
    public function destroy(string $id)
    {
        return Grupo::destroy($id);
    }

    /** OUTROS **/
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
    /**  CRIA UM REGISTRO NA TABELA DE UM USUARIO LOGADO EM UM GRUPO **/
    public function usuarioLogadoGrupo(string $id)
    {
        $user = auth()->user();
        $user->grupo()->attach($id);
        $grupo=Grupo::findOrFail($id);
       // $totalNoGrupo = count($user->grupo());
        return [
            'usuario'=>$user->name,
            'grupo'=>$grupo->nome
            //'TotalNoGrupo'=>$totalNoGrupo
        ];
    }
    /**  CRIA UM REGISTRO NA TABELA DE UM USUARIO EM UM GRUPO **/
    public function usuarioGrupo(Request $request)
    {
        $user = User::findOrFail($request->idUser);
        $user->grupo()->attach($request->idGrupo);
        $grupo=Grupo::findOrFail($request->idGrupo);
        return [
            'usuario'=>$user->name,
            'grupo'=>$grupo->nome
            //'TotalNoGrupo'=>$totalNoGrupo
        ];
    }

    /**  EXCLUI UM REGISTRO NA TABELA DE UM USUARIO EM UM GRUPO **/
    public function excluiUsuarioGrupo(Request $request)
    {
        $idGrupo = $request->idGrupo;
        $idUser = $request->idUser;
        $user = User::findOrFail($idUser);
        $user->grupo()->detach($idGrupo);
        //$totalNoGrupo = count($user->grupo());
        return [
            'usuario'=>$user->name
          //  'TotalNoGrupo'=>$totalNoGrupo
        ];
    }
    /**  LISTA GRUPOS DE UM USUARIO EM UM GRUPO **/
    public function listaGruposUsuario($id){
        $user = User::findOrFail($id);
        return $user->grupo;
    }
    /**  LISTA USUARIOS DE UM GRUPO **/
    public function listaUsuariosGrupo($id){
        $grupo = Grupo::findOrFail($id);
        return $grupo->user;
    }


    /**
     * Associar um usuario a um grupo
     */
    // public function agroup(Request $request, string $id)
    // {
    //     $user = User::findOrFail($id);
    //     $user::where('id', $id)->update(['grupo_id' => $request->idGrupo]);
    //     return ['msg'=>'atualizado'];
    // }
    /**
     * Associar um usuario a um grupo
     */

}
