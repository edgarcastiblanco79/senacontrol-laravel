<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $ID_ROL
 * @property int|null $ID_PERMISO_FK
 * @property Carbon|null $FECHA_INICIO
 * @property Carbon|null $FECHA_CADUCIDAD
 * 
 * @property Permiso|null $permiso
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';
	protected $primaryKey = 'ID_ROL';
	public $timestamps = false;

	protected $casts = [
		'ID_PERMISO_FK' => 'int',
		'FECHA_INICIO' => 'datetime',
		'FECHA_CADUCIDAD' => 'datetime'
	];

	protected $fillable = [
		'ID_PERMISO_FK',
		'FECHA_INICIO',
		'FECHA_CADUCIDAD'
	];

	public function permiso()
	{
		return $this->belongsTo(Permiso::class, 'ID_PERMISO_FK');
	}

	public function usuarios()
	{
		return $this->hasMany(Usuario::class, 'ROLES_FK');
	}
}
