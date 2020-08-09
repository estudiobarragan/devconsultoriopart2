<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medicos';
    protected $fillable = [
        'nombre', 'descripcion'
    ];

    public function especialidades()
    {
        return $this->belongsToMany('App\Especialidad', 'medico_especialidad', 'id_medico', 'id_especialidad');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User','id_user');
    }

    public function tieneEspecialidad($id){
        foreach($this->especialidades as $especialidad){
            if($id === $especialidad->id) return true;
        }
        return false;
    }
}
