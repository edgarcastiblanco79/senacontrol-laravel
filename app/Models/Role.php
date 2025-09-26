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
 * @property int $id_rol
 * @property Carbon $fecha_inicio
 * @property Carbon $fecha_caducidad
 * @property int|null $id_permiso
 * 
 * @property Permiso|null $permiso
 * @property Collection|Usuario[] $usuarios
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';
	protected $primaryKey = 'id_rol';
	public $timestamps = false;

	protected $casts = [
		'fecha_inicio' => 'datetime',
		'fecha_caducidad' => 'datetime',
		'id_permiso' => 'int'
	];

	protected $fillable = [
		'fecha_inicio',
		'fecha_caducidad',
		'id_permiso'
	];

	public function permiso()
	{
		return $this->belongsTo(Permiso::class, 'id_permiso');
	}

	public function usuarios()
	{
		return $this->hasMany(Usuario::class, 'id_rol');
	}
}
