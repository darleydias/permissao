<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SistemaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\FuncionalidadeController;
use App\Http\Controllers\PermissaoController;
use App\Http\Controllers\AuthController;


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
Route::post('/logout',[AuthController::class,'logout']);




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
Route::get('/grupo/{id}/funcionalidades',[GrupoController::class,'listaFuncGrupo']);

//  ##################    USUARIO    ##################

Route::patch('/usuario/{id}',[GrupoController::class,'agroup']);
Route::get('/usuario',[AuthController::class,'index']);


//  ##################    FUNCIONALIDADE    ##################

Route::get('/funcionalidade',[FuncionalidadeController::class,'index']);
Route::post('/funcionalidade',[FuncionalidadeController::class,'store']);
Route::get('/funcionalidade/{id}',[FuncionalidadeController::class,'show']);
Route::put('/funcionalidade/{id}',[FuncionalidadeController::class,'update']);
Route::delete('/funcionalidade/{id}',[FuncionalidadeController::class,'destroy']);

//  ##################    PERMISSAO    ##################

Route::get('/permissao',[PermissaoController::class,'index']);
Route::post('/permissao',[PermissaoController::class,'store']);
Route::get('/permissao/{id}',[PermissaoController::class,'show']);
Route::put('/permissao/{id}',[PermissaoController::class,'update']);
Route::delete('/permissao/{id}',[PermissaoController::class,'destroy']);


Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('/acl',[AuthController::class,'acl']);
});

