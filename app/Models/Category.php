<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
	public function products()
	{
		return $this->belongsToMany(Product::class);
	}

	public static function getOptionString($default = 0)
	{
		$options = '<option value="0">All Categories</option>';

		$cats = DB::table('categories')->orderBy('title')->get();

		foreach ($cats as $cat) {
			$selected = $default == $cat->id ? ' selected="selected"' : '';
			$options .= "<option value=\"{$cat->id}\"$selected>{$cat->title}</option>";
		}

		return $options;
	}
}
