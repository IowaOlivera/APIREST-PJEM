<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Examen extends Model
{
    use HasFactory;
    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $primaryKey = 'idExamen';
    protected $table = 'tblexamenes';
    protected $fillable = [
        'idUsuario',
        'numPreguntas'
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            Bitacora::saveBitacora(Auth::id(), 1, 'Sin observaciones');
        });
        static::updated(function ($model) {
            Bitacora::saveBitacora(Auth::id(), 2, 'Sin observaciones');
        });
        static::deleted(function ($model) {
            Bitacora::saveBitacora(Auth::id(), 3, 'Sin observaciones');
        });
    }
}
