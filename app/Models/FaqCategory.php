<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
	public function faq_questions()
	{
		return $this->hasMany(FaqQuestion::class);
	}
}
