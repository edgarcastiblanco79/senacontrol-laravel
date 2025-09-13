<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property int $ID_USUARIO
 * @property string|null $NOMBRE
 * @property string|null $CONTRASENA
 * @property string|null $EMAIL
 * @property string|null $CATEGORIA
 * @property Carbon|null $FECHA_NACIMIENTO
 * @property string|null $ESTATUS
 * @property int|null $ROLES_FK
 * 
 * @property Role|null $role
 * @property Collection|Equipo[] $equipos
 * @property Collection|Perfil[] $perfils
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuario';
	protected $primaryKey = 'ID_USUARIO';
	public $timestamps = false;

	protected $casts = [
		'FECHA_NACIMIENTO' => 'datetime',
		'ROLES_FK' => 'int'
	];

	protected $fillable = [
		'NOMBRE',
		'CONTRASENA',
		'EMAIL',
		'CATEGORIA',
		'FECHA_NACIMIENTO',
		'ESTATUS',
		'ROLES_FK'
	];

	public function role()
	{
		return $this->belongsTo(Role::class, 'ROLES_FK');
	}

	public function equipos()
	{
		return $this->hasMany(Equipo::class, 'ID_PROPIETARIOPC');
	}

	public function perfils()
	{
		return $this->hasMany(Perfil::class, 'ID_USUARIO_FK');
	}
}
