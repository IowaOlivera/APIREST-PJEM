<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;
    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $primaryKey = 'cveRespuesta';
    protected $table = 'tblrespuestas';
    protected $fillable = [
        'cvePregunta',
        'desRespuesta',
        'activo',
        'correcta'
    ];
}
