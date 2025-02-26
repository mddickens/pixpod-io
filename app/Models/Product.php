<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
	use HasFactory;
	use InteractsWithMedia;

	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('blanks')->singleFile()
			->useFallbackUrl(config('pla.no_image_url'));

		$this->addMediaCollection('catalog')
			->useFallbackUrl(config('pla.no_image_url'));
	}

	public function registerMediaConversions(Media $media = null): void
	{
		$this->addMediaConversion('thumb')
			->performOnCollections('blanks', 'catalog')
			->width(150)
			->height(150)
			->sharpen(10);

		$this->addMediaConversion('half')
			->performOnCollections('blanks', 'catalog')
			->width(450)
			->height(450)
			->sharpen(10);
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class);
	}

	public function variants()
	{
		return $this->hasMany(Variant::class);
	}
}
