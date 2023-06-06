<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sukien
 * 
 * @property int $maSuKien
 * @property string $TenSuKien
 * @property string|null $Mota
 * @property Carbon $NgayBatDau
 * @property Carbon|null $NgayKetThuc
 * @property int $MaDDDL
 * 
 * @property Diadiemdulich $diadiemdulich
 * @property Collection|Hinhanhsukien[] $hinhanhsukiens
 *
 * @package App\Models
 */
class Sukien extends Model
{
	protected $table = 'sukien';
	protected $primaryKey = 'maSuKien';
	public $timestamps = false;

	protected $casts = [
		'MaDDDL' => 'int'
	];

	protected $dates = [
		'NgayBatDau',
		'NgayKetThuc'
	];

	protected $fillable = [
		'TenSuKien',
		'Mota',
		'NgayBatDau',
		'NgayKetThuc',
		'MaDDDL'
	];

	public function diadiemdulich()
	{
		return $this->belongsTo(Diadiemdulich::class, 'MaDDDL');
	}

	public function hinhanhsukiens()
	{
		return $this->hasMany(Hinhanhsukien::class, 'MaSuKien');
	}
}
