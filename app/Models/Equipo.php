<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Equipo
 * 
 * @property int $ID_DISPOSITIVO
 * @property string|null $MARCA
 * @property string|null $REFERENCIA
 * @property string|null $COLOR
 * @property string|null $TIPO_REFERENCIA
 * @property string|null $NUM_REFERENCIA
 * @property string|null $NOMBRE_PROPIETARIO
 * @property int|null $ID_PROPIETARIOPC
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Equipo extends Model
{
	protected $table = 'equipos';
	protected $primaryKey = 'ID_DISPOSITIVO';
	public $timestamps = false;

	protected $casts = [
		'ID_PROPIETARIOPC' => 'int'
	];

	protected $fillable = [
		'MARCA',
		'REFERENCIA',
		'COLOR',
		'TIPO_REFERENCIA',
		'NUM_REFERENCIA',
		'NOMBRE_PROPIETARIO',
		'ID_PROPIETARIOPC'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'ID_PROPIETARIOPC');
	}
}
