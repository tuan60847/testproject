<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hinhanhdddl
 * 
 * @property string $src
 * @property int $MaDDDL
 * 
 * @property Diadiemdulich $diadiemdulich
 *
 * @package App\Models
 */
class Hinhanhdddl extends Model
{
	protected $table = 'hinhanhdddl';
	protected $primaryKey = 'src';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'MaDDDL' => 'int'
	];

	protected $fillable = [
		'MaDDDL'
	];

	public function diadiemdulich()
	{
		return $this->belongsTo(Diadiemdulich::class, 'MaDDDL');
	}
}
