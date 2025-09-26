<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $casts = [
        'fecha_nacimiento' => 'datetime',
        'id_rol' => 'int',
        'user_id' => 'int', // <-- corregido
    ];

    protected $fillable = [
        'nombre',
        'apellido',
        'contrasena',
        'tipo_documento',
        'numero_documento',
        'email',
        'genero',
        'fecha_nacimiento',
        'estatus',
        'id_rol',
        'user_id', // <-- agregado
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_rol');
    }

    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'id_usuario');
    }

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'id_usuario');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
