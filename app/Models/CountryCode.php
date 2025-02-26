<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CountryCode extends Model
{
	public static function isValid($code)
	{
		return DB::table('country_codes')->where(['iso_2' => $code, 'is_active' => true])->exists();
	}

	public static function getName($code)
	{
		$country = DB::table('country_codes')->where('iso_2', $code)->first();

		return $country ? $country->name : 'Unknown';
	}

	public static function getOptionString($default = '')
	{
		$options = '';

		$codes = DB::table('country_codes')->where('is_active', true)->orderBy('name')->get();

		foreach ($codes as $code) {
			$selected = $default == $code->iso_2 ? ' selected="selected"' : '';
			$options .= "<option value=\"{$code->iso_2}\"$selected>{$code->name}</option>";
		}

		return $options;
	}
}
