<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ctddp
 * 
 * @property int $UIDCTDDP
 * @property string $MaDDP
 * @property int $UIDLoaiPhong
 * @property int $SoNgayO
 * @property int $soLuongPhong
 * @property float $Tien
 * 
 * @property Dondatphong $dondatphong
 * @property Loaiphong $loaiphong
 *
 * @package App\Models
 */
class Ctddp extends Model
{
	protected $table = 'ctddp';
	protected $primaryKey = 'UIDCTDDP';
	public $timestamps = false;

	protected $casts = [
		'UIDLoaiPhong' => 'int',
		'SoNgayO' => 'int',
		'soLuongPhong' => 'int',
		'Tien' => 'float'
	];

	protected $fillable = [
		'MaDDP',
		'UIDLoaiPhong',
		'SoNgayO',
		'soLuongPhong',
		'Tien'
	];

	public function dondatphong()
	{
		return $this->belongsTo(Dondatphong::class, 'MaDDP');
	}

	public function loaiphong()
	{
		return $this->belongsTo(Loaiphong::class, 'UIDLoaiPhong');
	}
}
