<?php
namespace App\Models\Traits;
trait UserACLTrait{
    public function permissao(){
        
        $grupoDaPessoa = $this->grupo()->first();
        $funcoes=[];
        foreach($grupoDaPessoa->funcionalidade as $func){
            array_push($funcoes,$func);
        }
        return $funcoes; 
    }
}
?>