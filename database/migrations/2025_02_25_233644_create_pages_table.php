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
		Schema::create('pages', function (Blueprint $table) {
			$table->id();
			$table->string('slug')->unique();
			$table->string('title');
			$table->string('link')->nullable();
			$table->string('excerpt')->nullable();
			$table->mediumText('body');
			$table->string('file_name')->nullable();
			$table->string('file_path')->nullable();
			$table->unsignedInteger('file_size')->default(0);
			$table->boolean('is_visible')->default(true);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('pages');
	}
};
