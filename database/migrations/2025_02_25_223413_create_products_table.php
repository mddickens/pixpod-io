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
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('slug')->unique();
			$table->mediumText('description')->nullable();
			$table->string('material')->nullable();
			$table->string('packaging')->nullable();
			$table->mediumText('search_terms')->nullable();
			$table->unsignedTinyInteger('sort_order')->nullable()->default(0);
			$table->boolean('is_active')->nullable()->default(true);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('products');
	}
};
