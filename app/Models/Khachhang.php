<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Khachhang
 * 
 * @property string $Email
 * @property string $Password
 * @property string $HoTen
 * @property Carbon $NgaySinh
 * @property string $SDT
 * @property string $cmnd
 * @property bool $isDatPhong
 * 
 * @property Collection|Dondatphong[] $dondatphongs
 * @property Collection|Favorite[] $favorites
 *
 * @package App\Models
 */
class Khachhang extends Model
{
	protected $table = 'khachhang';
	protected $primaryKey = 'Email';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'isDatPhong' => 'bool'
	];

	protected $dates = [
		'NgaySinh'
	];

	protected $fillable = [
		'Password',
		'HoTen',
		'NgaySinh',
		'SDT',
		'cmnd',
		'isDatPhong'
	];

	public function dondatphongs()
	{
		return $this->hasMany(Dondatphong::class, 'EmailKH');
	}

	public function favorites()
	{
		return $this->hasMany(Favorite::class, 'Email');
	}
}
