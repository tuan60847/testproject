<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Diadiemdulich
 * 
 * @property int $MaDDDL
 * @property string $TenDiaDiemDuLich
 * @property string $DiaChi
 * @property string|null $MoTa
 * @property string|null $GiaTien
 * @property int $MaTP
 * @property string $ThoiGianHoatDong
 * 
 * @property Thanhpho $thanhpho
 * @property Collection|Hinhanhdddl[] $hinhanhdddls
 * @property Collection|Khachsan[] $khachsans
 * @property Collection|Sukien[] $sukiens
 *
 * @package App\Models
 */
class Diadiemdulich extends Model
{
	protected $table = 'diadiemdulich';
	protected $primaryKey = 'MaDDDL';
	public $timestamps = false;

	protected $casts = [
		'MaTP' => 'int'
	];

	protected $fillable = [
		'TenDiaDiemDuLich',
		'DiaChi',
		'MoTa',
		'GiaTien',
		'MaTP',
		'ThoiGianHoatDong'
	];

	public function thanhpho()
	{
		return $this->belongsTo(Thanhpho::class, 'MaTP');
	}

	public function hinhanhdddls()
	{
		return $this->hasMany(Hinhanhdddl::class, 'MaDDDL');
	}

	public function khachsans()
	{
		return $this->hasMany(Khachsan::class, 'MaDDDL');
	}

	public function sukiens()
	{
		return $this->hasMany(Sukien::class, 'MaDDDL');
	}
}
