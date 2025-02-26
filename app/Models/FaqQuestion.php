<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqQuestion extends Model
{
	public function faq_category()
	{
		return $this->belongsTo(FaqCategory::class);
	}
}
