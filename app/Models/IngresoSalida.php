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
 * @property int $ID_INGRESO_SALIDA
 * @property int|null $ID_PERFIL_FK
 * @property Carbon|null $FECHA
 * @property Carbon|null $HORA_INGRESO
 * @property Carbon|null $HORA_SALIDA
 * 
 * @property Perfil|null $perfil
 * @property Collection|Reporte[] $reportes
 *
 * @package App\Models
 */
class IngresoSalida extends Model
{
	protected $table = 'ingreso_salida';
	protected $primaryKey = 'ID_INGRESO_SALIDA';
	public $timestamps = false;

	protected $casts = [
		'ID_PERFIL_FK' => 'int',
		'FECHA' => 'datetime',
		'HORA_INGRESO' => 'datetime',
		'HORA_SALIDA' => 'datetime'
	];

	protected $fillable = [
		'ID_PERFIL_FK',
		'FECHA',
		'HORA_INGRESO',
		'HORA_SALIDA'
	];

	public function perfil()
	{
		return $this->belongsTo(Perfil::class, 'ID_PERFIL_FK');
	}

	public function reportes()
	{
		return $this->hasMany(Reporte::class, 'ID_INGRESO_SALIDA');
	}
}
