<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Perfil
 * 
 * @property int $ID_PERFIL
 * @property int|null $ID_USUARIO_FK
 * @property string|null $DESCRIPCION
 * 
 * @property Usuario|null $usuario
 * @property Collection|IngresoSalida[] $ingreso_salidas
 *
 * @package App\Models
 */
class Perfil extends Model
{
	protected $table = 'perfil';
	protected $primaryKey = 'ID_PERFIL';
	public $timestamps = false;

	protected $casts = [
		'ID_USUARIO_FK' => 'int'
	];

	protected $fillable = [
		'ID_USUARIO_FK',
		'DESCRIPCION'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'ID_USUARIO_FK');
	}

	public function ingreso_salidas()
	{
		return $this->hasMany(IngresoSalida::class, 'ID_PERFIL_FK');
	}
}
