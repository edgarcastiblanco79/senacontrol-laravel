<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vehiculo
 * 
 * @property int $id_vehiculo
 * @property string|null $numero_chasis
 * @property string|null $placa
 * @property string|null $tipo
 * @property string|null $marca
 * @property string|null $modelo
 * @property string|null $color
 * @property int|null $id_usuario
 * 
 * @property Usuario|null $usuario
 * @property Collection|Movimiento[] $movimientos
 *
 * @package App\Models
 */
class Vehiculo extends Model
{
	protected $table = 'vehiculos';
	protected $primaryKey = 'id_vehiculo';
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int'
	];

	protected $fillable = [
		'numero_chasis',
		'placa',
		'tipo',
		'marca',
		'modelo',
		'color',
		'id_usuario'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario');
	}

	public function movimientos()
	{
		return $this->hasMany(Movimiento::class, 'id_vehiculo');
	}
}
