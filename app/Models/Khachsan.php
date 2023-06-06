<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Khachsan
 * 
 * @property string $UIDKS
 * @property string $TenKS
 * @property string $DiaChi
 * @property string $SDT
 * @property bool $Buffet
 * @property bool $Wifi
 * @property bool $isActive
 * @property int $MaDDDL
 * 
 * @property Chukhachsan $chukhachsan
 * @property Diadiemdulich $diadiemdulich
 * @property Collection|Hinhanhk[] $hinhanhks
 * @property Collection|Loaiphong[] $loaiphongs
 *
 * @package App\Models
 */
class Khachsan extends Model
{
	protected $table = 'khachsan';
	protected $primaryKey = 'UIDKS';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Buffet' => 'bool',
		'Wifi' => 'bool',
		'isActive' => 'bool',
		'MaDDDL' => 'int'
	];

	protected $fillable = [
		'TenKS',
		'DiaChi',
		'SDT',
		'Buffet',
		'Wifi',
		'isActive',
		'MaDDDL'
	];

	public function chukhachsan()
	{
		return $this->belongsTo(Chukhachsan::class, 'UIDKS', 'ADMINKS');
	}

	public function diadiemdulich()
	{
		return $this->belongsTo(Diadiemdulich::class, 'MaDDDL');
	}

	public function hinhanhks()
	{
		return $this->hasMany(Hinhanhk::class, 'UIDKS');
	}

	public function loaiphongs()
	{
		return $this->hasMany(Loaiphong::class, 'UIDKS');
	}
}
