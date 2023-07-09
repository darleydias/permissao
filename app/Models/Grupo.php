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
    public function user(){ // Associo os usuário a um grupo. Um usuário não tem mais de um grupo
        return $this->hasMany(User::class);
    }
    public function funcionalidade(){
        return $this->hasMany(Funcionalidade::class);
    }
}
