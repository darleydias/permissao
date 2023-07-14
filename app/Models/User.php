<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Traits\UserACLTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,UserACLTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'grupo_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function grupo(){
        return $this->belongsToMany(Grupo::class,'grupo_usuario');
    }
    public function funcionalidades(){
        return User::where('users.id', $this->id)
        ->leftJoin('grupo_usuario', 'grupo_usuario.user_id', '=', 'users.id')
        ->leftJoin('grupo', 'grupo_usuario.grupo_id', '=', 'grupo.id')
        ->leftJoin('funcionalidade_grupo', 'funcionalidade_grupo.grupo_id', '=', 'grupo.id')
        ->leftJoin('funcionalidade', 'funcionalidade_grupo.funcionalidade_id', '=', 'funcionalidade.id')
        ->whereNotNull('funcionalidade.URL')
        ->select('funcionalidade.URL')->get()->all();
    } 
}
