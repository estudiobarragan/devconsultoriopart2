<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidades';
    public $timestamps = false;
    protected $fillable = [
        'nombre', 'descripcion'
    ];
}
