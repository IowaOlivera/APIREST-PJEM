<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pregunta extends Model
{
    use HasFactory;
    protected $primaryKey = 'cvePregunta';
    protected $table = 'tblpreguntas';
    protected $fillable = [
        'desPregunta',
        'activo'
    ];
    const CREATED_AT = null;
    const UPDATED_AT = null;

    public static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            Bitacora::saveBitacora(auth()->id() , 1, 'Sin observaciones');
        });
        static::updated(function ($model) {
            Bitacora::saveBitacora(auth()->id(), 2, 'Sin observaciones');
        });
        static::deleted(function ($model) {
            Bitacora::saveBitacora(auth()->id(), 3, 'Sin observaciones');
        });
    }


    public function respuestas(): HasMany
    {
        return $this->hasMany(Respuesta::class, 'cvePregunta', 'cvePregunta');
    }
}
