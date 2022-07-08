<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $primaryKey = 'idUsuario';
    protected $table = 'tblusuarios';
    protected $fillable = [
        'nombre',
        'paterno',
        'materno',
        'login',
        'password',
        'activo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'login',
    ];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope('activo', function ($builder) {
            $builder->where('activo', 1);
        });
        static::created(function ($model) {
            Bitacora::saveBitacora(auth()->id(), 4, 'Se creó un usuario');
        });
        static::updated(function ($model) {
            Bitacora::saveBitacora(auth()->id(), 5, 'Se modificó un usuario');
        });
        static::deleted(function ($model) {
            Bitacora::saveBitacora(auth()->id(), 6, 'Se eliminó un usuario');
        });
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
