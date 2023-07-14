<?php

namespace App\Models;
use App\Models\Funcionalidade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    use HasFactory;
    protected $table = 'sistema';

    protected $fillable = array(
        'nome'
    );
    public function funcionalidade(){
        return $this->hasMany(Funcionalidade::class);
    }
}
