<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reporte
 * 
 * @property int $ID_REPORTES
 * @property int|null $ID_INGRESO_SALIDA
 * 
 * @property IngresoSalida|null $ingreso_salida
 *
 * @package App\Models
 */
class Reporte extends Model
{
	protected $table = 'reportes';
	protected $primaryKey = 'ID_REPORTES';
	public $timestamps = false;

	protected $casts = [
		'ID_INGRESO_SALIDA' => 'int'
	];

	protected $fillable = [
		'ID_INGRESO_SALIDA'
	];

	public function ingreso_salida()
	{
		return $this->belongsTo(IngresoSalida::class, 'ID_INGRESO_SALIDA');
	}
}
