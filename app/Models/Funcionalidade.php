<?php

namespace App\Models;
use App\Models\Grupo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionalidade extends Model
{
    use HasFactory;
    protected $table = 'funcionalidade';

    protected $fillable = array(
        'nome',
        'URL',
        'sistema_id'
    );

    public function grupo(){
        return $this->belongsToMany(Grupo::class,'funcionalidade_grupo');
    }

    public function sistema(){
        return $this->belongsTo(Sistema::class);
    }
    
}
