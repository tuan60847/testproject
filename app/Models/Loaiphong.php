<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Loaiphong
 * 
 * @property int $UIDLoaiPhong
 * @property string $TenLoaiPhong
 * @property float $Gia
 * @property string $UIDKS
 * @property string $soGiuong
 * @property int $soLuongPhong
 * @property bool $isMayLanh
 * @property bool $isActive
 * 
 * @property Khachsan $khachsan
 * @property Collection|Ctddp[] $ctddps
 * @property Collection|Hinhanhloaiphong[] $hinhanhloaiphongs
 * @property Collection|Phongconlai[] $phongconlais
 *
 * @package App\Models
 */
class Loaiphong extends Model
{
	protected $table = 'loaiphong';
	protected $primaryKey = 'UIDLoaiPhong';
	public $timestamps = false;

	protected $casts = [
		'Gia' => 'float',
		'soLuongPhong' => 'int',
		'isMayLanh' => 'bool',
		'isActive' => 'bool'
	];

	protected $fillable = [
		'TenLoaiPhong',
		'Gia',
		'UIDKS',
		'soGiuong',
		'soLuongPhong',
		'isMayLanh',
		'isActive'
	];

	public function khachsan()
	{
		return $this->belongsTo(Khachsan::class, 'UIDKS');
	}

	public function ctddps()
	{
		return $this->hasMany(Ctddp::class, 'UIDLoaiPhong');
	}

	public function hinhanhloaiphongs()
	{
		return $this->hasMany(Hinhanhloaiphong::class, 'UIDLoaiPhong');
	}

	public function phongconlais()
	{
		return $this->hasMany(Phongconlai::class, 'UIDLoaiPhong');
	}
}
