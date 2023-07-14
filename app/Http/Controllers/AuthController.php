<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Funcionalidade;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'grupo_id'=>1,
            'password' => bcrypt($request->password)
        ]);
        $token = $user->createToken($request->nameToken)->plainTextToken;
        $result =[
            'user'=>$user,
            'token'=>$token
        ];

        return response($result,201);
    }
    public function index(){
        return User::all();
    }
    public function login(Request $request){
        $fields=$request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);
        $user = User::where('email',$fields['email'])->first();

        if(!$user||!Hash::check($fields['password'],$user->password)){
            return response(['message'=>'usuario ou senha inválidos'],401);
        };
        $token = $user->createToken('usuarioLogado')->plainTextToken;
        $result =[
            'user'=>$user,
            'token'=>$token
        ];

        return response($result,201);
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response(['message'=>'Usuário deslogado'],200);
    }
    public function acl(Request $request){
        $funcNome = $request->evento;
        $funcionalidade = Funcionalidade::where('nome',$funcNome)->first();
        $permissoes = auth()->user()->permissao();
        if(in_array($funcionalidade,$permissoes)){
            return  $funcionalidade->nome;
        }else{
            return  ['msg'=>'negado'];
        };
    }
    public function usuFunc($id){
        return $usuarioFunc = User::where('users.id', $id)
        ->leftJoin('grupo_usuario', 'grupo_usuario.user_id', '=', 'users.id')
        ->leftJoin('grupo', 'grupo_usuario.grupo_id', '=', 'grupo.id')
        ->leftJoin('funcionalidade_grupo', 'funcionalidade_grupo.grupo_id', '=', 'grupo.id')
        ->leftJoin('funcionalidade', 'funcionalidade_grupo.funcionalidade_id', '=', 'funcionalidade.id')
        ->whereNotNull('funcionalidade.URL')
        ->select('funcionalidade.URL')->get()->all();
    }
    public function usuLogadoFunc(){ //mostra funcionalidades do usuario logado
        $usuarioLogado = auth()->user();
        return $usuarioLogado->funcionalidades();
    }
}
