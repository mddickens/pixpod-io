<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AppLog extends Model
{
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public static function log_it($file, $message, $shop_id = 0)
	{
		$now = date('Y-m-d H:i:s');
		DB::table('app_logs')->insert([
			'user_id' => $shop_id,
			'file' => basename($file),
			'message' => $message,
			'created_at' => $now,
			'updated_at' => $now,
		]);
	}
}
