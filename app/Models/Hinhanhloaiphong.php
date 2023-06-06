<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hinhanhloaiphong
 * 
 * @property string $src
 * @property int $UIDLoaiPhong
 * 
 * @property Loaiphong $loaiphong
 *
 * @package App\Models
 */
class Hinhanhloaiphong extends Model
{
	protected $table = 'hinhanhloaiphong';
	protected $primaryKey = 'src';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'UIDLoaiPhong' => 'int'
	];

	protected $fillable = [
		'UIDLoaiPhong'
	];

	public function loaiphong()
	{
		return $this->belongsTo(Loaiphong::class, 'UIDLoaiPhong');
	}
}
