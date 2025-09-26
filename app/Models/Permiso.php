<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permiso
 * 
 * @property int $id_permiso
 * @property string $tipo_de_permiso
 * @property Carbon $fecha_inicio
 * @property Carbon $fecha_caducidad
 * 
 * @property Collection|Role[] $roles
 *
 * @package App\Models
 */
class Permiso extends Model
{
	protected $table = 'permisos';
	protected $primaryKey = 'id_permiso';
	public $timestamps = false;

	protected $casts = [
		'fecha_inicio' => 'datetime',
		'fecha_caducidad' => 'datetime'
	];

	protected $fillable = [
		'tipo_de_permiso',
		'fecha_inicio',
		'fecha_caducidad'
	];

	public function roles()
	{
		return $this->hasMany(Role::class, 'id_permiso');
	}
}
