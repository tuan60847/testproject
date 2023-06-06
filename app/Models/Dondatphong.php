<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dondatphong
 * 
 * @property string $UIDDatPhong
 * @property string $EmailKH
 * @property Carbon|null $NgayDatPhong
 * @property int $isChecked
 * @property float|null $TienCoc
 * @property float $tongtien
 * 
 * @property Khachhang $khachhang
 * @property Collection|Ctddp[] $ctddps
 *
 * @package App\Models
 */
class Dondatphong extends Model
{
	protected $table = 'dondatphong';
	protected $primaryKey = 'UIDDatPhong';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'isChecked' => 'int',
		'TienCoc' => 'float',
		'tongtien' => 'float'
	];

	protected $dates = [
		'NgayDatPhong'
	];

	protected $fillable = [
		'EmailKH',
		'NgayDatPhong',
		'isChecked',
		'TienCoc',
		'tongtien'
	];

	public function khachhang()
	{
		return $this->belongsTo(Khachhang::class, 'EmailKH');
	}

	public function ctddps()
	{
		return $this->hasMany(Ctddp::class, 'MaDDP');
	}
}
