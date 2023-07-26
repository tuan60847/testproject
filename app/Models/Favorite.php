<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Favorite
 * 
 * @property int $index
 * @property string $Email
 * @property string $UIDKS
 * @property bool $isActive
 * 
 * @property Khachsan $khachsan
 * @property Khachhang $khachhang
 *
 * @package App\Models
 */
class Favorite extends Model
{
	protected $table = 'favorite';
	protected $primaryKey = 'index';
	public $timestamps = false;

	protected $casts = [
		'isActive' => 'bool'
	];

	protected $fillable = [
		'Email',
		'UIDKS',
		'isActive'
	];

	public function khachsan()
	{
		return $this->belongsTo(Khachsan::class, 'UIDKS');
	}

	public function khachhang()
	{
		return $this->belongsTo(Khachhang::class, 'Email');
	}
}
