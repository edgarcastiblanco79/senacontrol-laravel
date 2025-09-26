<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IngresoSalida
 * 
 * @property int $id_ingreso_salida
 * @property Carbon $fecha
 * @property Carbon $hora_ingreso
 * @property Carbon|null $hora_salida
 * @property string|null $tipo_movimiento
 * @property string|null $metodo_validacion
 * @property string|null $observaciones
 * @property string|null $estado
 * 
 * @property Collection|Movimiento[] $movimientos
 * @property Collection|Reporte[] $reportes
 *
 * @package App\Models
 */
class IngresoSalida extends Model
{
	protected $table = 'ingreso_salida';
	protected $primaryKey = 'id_ingreso_salida';
	public $timestamps = false;

	protected $casts = [
		'fecha' => 'datetime',
		'hora_ingreso' => 'datetime',
		'hora_salida' => 'datetime'
	];

	protected $fillable = [
		'fecha',
		'hora_ingreso',
		'hora_salida',
		'tipo_movimiento',
		'metodo_validacion',
		'observaciones',
		'estado'
	];

	public function movimientos()
	{
		return $this->hasMany(Movimiento::class, 'id_ingreso_salida');
	}

	public function reportes()
	{
		return $this->hasMany(Reporte::class, 'id_ingreso_salida');
	}
}
