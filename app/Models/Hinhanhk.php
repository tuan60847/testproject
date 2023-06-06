<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hinhanhk
 * 
 * @property string $src
 * @property string $UIDKS
 * 
 * @property Khachsan $khachsan
 *
 * @package App\Models
 */
class Hinhanhk extends Model
{
	protected $table = 'hinhanhks';
	protected $primaryKey = 'src';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'UIDKS'
	];

	public function khachsan()
	{
		return $this->belongsTo(Khachsan::class, 'UIDKS');
	}
}
