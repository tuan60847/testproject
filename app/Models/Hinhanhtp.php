<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hinhanhtp
 * 
 * @property string $src
 * @property int $MaTP
 * 
 * @property Thanhpho $thanhpho
 *
 * @package App\Models
 */
class Hinhanhtp extends Model
{
	protected $table = 'hinhanhtp';
	protected $primaryKey = 'src';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'MaTP' => 'int'
	];

	protected $fillable = [
		'MaTP'
	];

	public function thanhpho()
	{
		return $this->belongsTo(Thanhpho::class, 'MaTP');
	}
}
