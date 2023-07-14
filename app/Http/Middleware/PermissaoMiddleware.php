<?php
/*## Esse middleware verifica se o usuario logado tem permissao para acessar a rota que foi chamada ##*/
/*## Em cada arquivo de rota deve ser chamado esse meddleware e tambem o meddleware de login  ##*/
/*## "$rota" pega a String da rota e "$funcionalidades" pega as funcionalidades do usuario logado  ##*/
/*## "Testa e encaminha  ##*/

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rota=$request->getRequestUri();
        $funcionalidades = auth()->user()->funcionalidades();
        $permitido=0;
        foreach($funcionalidades as $func){
            if($func->URL==$rota){$permitido=$permitido+1;};
        }
        if($permitido > 0){
            return $next($request);
        }else{
            abort(response()->json(['error' => 'Acesso não permitido'.$rota], 401));
        }
        
    }
}
