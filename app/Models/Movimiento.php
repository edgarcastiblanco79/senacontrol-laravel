<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Movimiento
 * 
 * @property int $id_movimiento
 * @property int|null $id_ingreso_salida
 * @property int|null $id_equipo
 * @property int|null $id_vehiculo
 * 
 * @property IngresoSalida|null $ingreso_salida
 * @property Equipo|null $equipo
 * @property Vehiculo|null $vehiculo
 *
 * @package App\Models
 */
class Movimiento extends Model
{
	protected $table = 'movimientos';
	protected $primaryKey = 'id_movimiento';
	public $timestamps = false;

	protected $casts = [
		'id_ingreso_salida' => 'int',
		'id_equipo' => 'int',
		'id_vehiculo' => 'int'
	];

	protected $fillable = [
		'id_ingreso_salida',
		'id_equipo',
		'id_vehiculo'
	];

	public function ingreso_salida()
	{
		return $this->belongsTo(IngresoSalida::class, 'id_ingreso_salida');
	}

	public function equipo()
	{
		return $this->belongsTo(Equipo::class, 'id_equipo');
	}

	public function vehiculo()
	{
		return $this->belongsTo(Vehiculo::class, 'id_vehiculo');
	}
}
