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
        'sistema_id',
        'grupo_id'
    );

    public function Grupo(){
        return $this->belongsTo(Grupo::class);
    }
    public function Sistema(){
        return $this->belongsTo(Sistema::class);
    }
    
}
