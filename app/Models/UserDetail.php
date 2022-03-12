<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserDetail
 * 
 * @property int $id
 * @property int $user_id
 * @property int $citizenship_country_id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone_number
 *
 * @package App\Models
 */
class UserDetail extends Model
{
	protected $table = 'user_details';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'citizenship_country_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'citizenship_country_id',
		'first_name',
		'last_name',
		'phone_number'
	];
}
