<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;

class OrderRequest extends Model
{
	protected static function booted(): void
	{
		static::addGlobalScope(new UserScope());
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function order_request_lines()
	{
		return $this->hasMany(OrderRequestLine::class);
	}

	public function get_product_total()
	{
		return OrderRequestLine::where('order_request_id', $this->id)->sum('total');
	}
}
