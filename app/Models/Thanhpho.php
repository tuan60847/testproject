<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Thanhpho
 * 
 * @property int $MaTP
 * @property string $TenTP
 * 
 * @property Collection|Diadiemdulich[] $diadiemduliches
 * @property Collection|Hinhanhtp[] $hinhanhtps
 *
 * @package App\Models
 */
class Thanhpho extends Model
{
	protected $table = 'thanhpho';
	protected $primaryKey = 'MaTP';
	public $timestamps = false;

	protected $fillable = [
		'TenTP'
	];

	public function diadiemduliches()
	{
		return $this->hasMany(Diadiemdulich::class, 'MaTP');
	}

	public function hinhanhtps()
	{
		return $this->hasMany(Hinhanhtp::class, 'MaTP');
	}
}
