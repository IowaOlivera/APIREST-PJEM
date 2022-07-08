<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;
    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $primaryKey = 'idBitacora';
    protected $table = 'tblbitacoras';
    protected $fillable = [
        'idUsuario',
        'cveAccion',
        'observaciones'
    ];

    public static function saveBitacora($idUsuario, $cveAccion, $observaciones)
    {
        Bitacora::create([
            'idUsuario' => $idUsuario,
            'cveAccion' => $cveAccion,
            'observaciones' => $observaciones
        ]);
    }
}
