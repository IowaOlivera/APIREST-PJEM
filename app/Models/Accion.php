<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    use HasFactory;
    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $primaryKey = 'cveAccion';
    protected $table = 'tblacciones';
    protected $fillable = [
        'desAccion',
        'activo'
    ];
    // public static function boot()
    // {
    //     parent::boot();
    //     static::created(function ($model) {
    //         Log::alert(json_encode($model, JSON_PRETTY_PRINT));
    //         Bitacora::saveBitacora(Auth::id(), 1, 'Sin observaciones');
    //     });
    //     static::updated(function ($model) {
    //         Log::alert(json_encode($model, JSON_PRETTY_PRINT));
    //         Bitacora::saveBitacora(Auth::id(), 2, 'Sin observaciones');
    //     });
    //     static::deleted(function ($model) {
    //         Log::alert(json_encode($model, JSON_PRETTY_PRINT));
    //         Bitacora::saveBitacora(Auth::id(), 3, 'Sin observaciones');
    //     });
    // }
}
