<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hinhanhsukien
 * 
 * @property string $src
 * @property int $MaSuKien
 * 
 * @property Sukien $sukien
 *
 * @package App\Models
 */
class Hinhanhsukien extends Model
{
	protected $table = 'hinhanhsukien';
	protected $primaryKey = 'src';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'MaSuKien' => 'int'
	];

	protected $fillable = [
		'MaSuKien'
	];

	public function sukien()
	{
		return $this->belongsTo(Sukien::class, 'MaSuKien');
	}
}
