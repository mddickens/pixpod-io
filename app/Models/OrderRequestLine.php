<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class OrderRequestLine extends Model implements HasMedia
{
	use InteractsWithMedia;

	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('orders');
	}

	public function order_request()
	{
		return $this->belongsTo(OrderRequest::class);
	}

	public function variant()
	{
		return $this->hasOne(Variant::class, 'sku', 'sku');
	}
}
