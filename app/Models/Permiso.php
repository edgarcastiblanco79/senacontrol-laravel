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
 * @property int $ID_PERMISO
 * @property string|null $TIPO_DE_PERMISO
 * @property Carbon|null $FECHA_ALTA
 * @property Carbon|null $FECHA_CADUCIDAD
 * 
 * @property Collection|Role[] $roles
 *
 * @package App\Models
 */
class Permiso extends Model
{
	protected $table = 'permisos';
	protected $primaryKey = 'ID_PERMISO';
	public $timestamps = false;

	protected $casts = [
		'FECHA_ALTA' => 'datetime',
		'FECHA_CADUCIDAD' => 'datetime'
	];

	protected $fillable = [
		'TIPO_DE_PERMISO',
		'FECHA_ALTA',
		'FECHA_CADUCIDAD'
	];

	public function roles()
	{
		return $this->hasMany(Role::class, 'ID_PERMISO_FK');
	}
}
