<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comision extends Model
{
    use SoftDeletes;

    protected $hidden = [
        'id_departamento',
        'id_facultad',
        'id_rol',
        'id_user',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }

    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'id_facultad');
    }

    public function rol_comision()
    {
        return $this->belongsTo(Rol_Comision::class, 'id_rol');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function getDepartamentoAttribute()
    {
        return $this->departamento()->first();
    }

    public function getFacultadAttribute()
    {
        return $this->facultad()->first();
    }

    public function getRolComisionAttribute()
    {
        return $this->rol_comision()->first();
    }

    public function getUsuarioAttribute()
    {
        return $this->usuario()->first();
    }
}
