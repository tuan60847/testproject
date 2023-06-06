<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Phongconlai
 * 
 * @property int $index
 * @property Carbon $Ngay
 * @property int $SoLuong
 * @property int $UIDLoaiPhong
 * 
 * @property Loaiphong $loaiphong
 *
 * @package App\Models
 */
class Phongconlai extends Model
{
	protected $table = 'phongconlai';
	protected $primaryKey = 'index';
	public $timestamps = false;

	protected $casts = [
		'SoLuong' => 'int',
		'UIDLoaiPhong' => 'int'
	];

	protected $dates = [
		'Ngay'
	];

	protected $fillable = [
		'Ngay',
		'SoLuong',
		'UIDLoaiPhong'
	];

	public function loaiphong()
	{
		return $this->belongsTo(Loaiphong::class, 'UIDLoaiPhong');
	}
}
