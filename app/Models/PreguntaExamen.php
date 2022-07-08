<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreguntaExamen extends Model
{
    use HasFactory;
    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $primaryKey = 'idExamenPregunta';
    protected $table = 'tblexamenespreguntas';
    protected $fillable = [
        'idExamen',
        'cvePregunta',
        'activo'
    ];
}
