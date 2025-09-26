<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reporte
 * 
 * @property int $id_reporte
 * @property int|null $id_ingreso_salida
 * @property Carbon|null $fecha_generacion
 * @property string|null $tipo_reportes
 * @property string|null $rango_fechas
 * @property string|null $contenido
 * @property string|null $archivo_url
 * 
 * @property IngresoSalida|null $ingreso_salida
 *
 * @package App\Models
 */
class Reporte extends Model
{
	protected $table = 'reportes';
	protected $primaryKey = 'id_reporte';
	public $timestamps = false;

	protected $casts = [
		'id_ingreso_salida' => 'int',
		'fecha_generacion' => 'datetime'
	];

	protected $fillable = [
		'id_ingreso_salida',
		'fecha_generacion',
		'tipo_reportes',
		'rango_fechas',
		'contenido',
		'archivo_url'
	];

	public function ingreso_salida()
	{
		return $this->belongsTo(IngresoSalida::class, 'id_ingreso_salida');
	}
}
