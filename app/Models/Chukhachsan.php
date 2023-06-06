<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Chukhachsan
 * 
 * @property string $Email
 * @property string $Password
 * @property string $HoTen
 * @property Carbon $NgaySinh
 * @property string $SDT
 * @property string $cmnd
 * @property string $ADMINKS
 * 
 * @property Khachsan $khachsan
 *
 * @package App\Models
 */
class Chukhachsan extends Model
{
	protected $table = 'chukhachsan';
	protected $primaryKey = 'Email';
	public $incrementing = false;
	public $timestamps = false;

	protected $dates = [
		'NgaySinh'
	];

	protected $fillable = [
		'Password',
		'HoTen',
		'NgaySinh',
		'SDT',
		'cmnd',
		'ADMINKS'
	];

	public function khachsan()
	{
		return $this->hasOne(Khachsan::class, 'UIDKS', 'ADMINKS');
	}
}
