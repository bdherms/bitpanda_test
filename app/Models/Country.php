<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $name
 * @property string $iso2
 * @property string|null $iso3
 *
 * @package App\Models
 */
class Country extends Model
{
	protected $table = 'countries';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'iso2',
		'iso3'
	];
}
