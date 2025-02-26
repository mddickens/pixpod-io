<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('country_codes', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('iso_2', 2)->index();
			$table->string('iso_3', 3)->index();
			$table->boolean('is_default')->default(false);
			$table->boolean('is_active')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('country_codes');
	}
};
