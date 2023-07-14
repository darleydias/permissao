<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SistemaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\FuncionalidadeController;
use App\Http\Controllers\PermissaoController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\PermissaoMiddleware;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

//  ##################    SISTEMA    ##################
Route::get('/sistema',[SistemaController::class,'index']);
Route::post('/sistema',[SistemaController::class,'store']);
Route::get('/sistema/{id}',[SistemaController::class,'show']);
Route::put('/sistema/{id}',[SistemaController::class,'update']);
Route::delete('/sistema/{id}',[SistemaController::class,'destroy']);
Route::get('/sistema/{id}/funcionalidades',[SistemaController::class,'listaFuncSistema']);

//  ##################    GRUPOS    ##################
Route::get('/grupo',[GrupoController::class,'index']);
Route::post('/grupo',[GrupoController::class,'store']);
Route::get('/grupo/{id}',[GrupoController::class,'show']);
Route::put('/grupo/{id}',[GrupoController::class,'update']);
Route::delete('/grupo/{id}',[GrupoController::class,'destroy']);
Route::get('/grupo/{id}/funcionalidades',[GrupoController::class,'listaFuncGrupo']);/**  CRIA UM REGISTRO NA TABELA DE UM USUARIO EM UM GRUPO **/
Route::get('/grupo/{id}/usuarios',[GrupoController::class,'listaUsuariosGrupo']); /**  LISTA USUARIOS DE UM GRUPO **/

//  ##################    USUARIO    ##################
Route::get('/usuario/{id}/grupos',[GrupoController::class,'listaGruposUsuario']);/**  LISTA GRUPOS DE UM USUARIO EM UM GRUPO **/

//  ##################    INICIO - ROTAS LOGADAS E AUTORIZADAS    ##################
// Todo sistema que for logar e autorizar deveria apontar para as tabelas daqui, implementar o md abaixo
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('/usuario',[AuthController::class,'index'])->middleware(PermissaoMiddleware::class);



});
//  ##################    FIM - ROTAS LOGADAS E AUTORIZADAS    ##################
Route::delete('/usuario/grupo',[GrupoController::class,'excluiUsuarioGrupo']);/**  EXCLUI UM REGISTRO NA TABELA DE UM USUARIO EM UM GRUPO **/
Route::post('/usuario/grupo',[GrupoController::class,'usuarioGrupo']); // Insere um usuário e grupo na tabela pivot
Route::get('/usuario/{id}/funcionalidades',[AuthController::class,'usuFunc']);

//  ##################    FUNCIONALIDADE    ##################

Route::get('/funcionalidade',[FuncionalidadeController::class,'index']);
Route::post('/funcionalidade',[FuncionalidadeController::class,'store']);
Route::get('/funcionalidade/{id}',[FuncionalidadeController::class,'show']);
Route::put('/funcionalidade/{id}',[FuncionalidadeController::class,'update']);
Route::delete('/funcionalidade/{id}',[FuncionalidadeController::class,'destroy']);
Route::post('/funcionalidade/grupo',[FuncionalidadeController::class,'funcionalidadeGrupo']); // Associa funcionalidade a grupo
Route::get('/grupo/{id}/funcionalidades',[FuncionalidadeController::class,'listaFuncionalidadesGrupo']);/**  LISTA GRUPOS DE UM FUNCIONALIDADES **/
Route::get('/funcionalidade/{id}/grupos',[FuncionalidadeController::class,'listaGruposFuncionalidade']);/**  LISTA GRUPOS em que um FUNCIONALIDADE está **/
Route::delete('/func/grupo',[FuncionalidadeController::class,'excluiFuncGrupo']);


//  ##################    PERMISSAO    ##################

Route::get('/permissao',[PermissaoController::class,'index']);
Route::post('/permissao',[PermissaoController::class,'store']);
Route::get('/permissao/{id}',[PermissaoController::class,'show']);
Route::put('/permissao/{id}',[PermissaoController::class,'update']);
Route::delete('/permissao/{id}',[PermissaoController::class,'destroy']);


Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('/acl',[AuthController::class,'acl']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::post('/logado/grupo/{id}',[GrupoController::class,'usuarioLogadoGrupo']);//Usuario logado inscreve-se num grupo
    Route::get('/logado/funcionalidades',[AuthController::class,'usuLogadoFunc']);
});

