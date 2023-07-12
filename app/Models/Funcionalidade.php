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

    public function grupo():BelongsToMany{
        return $this->belongsToMany(Grupo::class);
    }

    public function sistema(){
        return $this->belongsTo(Sistema::class);
    }
    
}
