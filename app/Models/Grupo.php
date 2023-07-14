<?php

namespace App\Models;
use App\Models\Funcionalidade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $table = 'grupo';

    protected $fillable = array(
        'nome'
    );
    public function user(){ 
        return $this->belongsToMany(User::class,'grupo_usuario')->withTimestamps();;
    }
    public function funcionalidade(){ 
        return $this->belongsToMany(Funcionalidade::class,'funcionalidade_grupo')->withTimestamps();;
    }
}
