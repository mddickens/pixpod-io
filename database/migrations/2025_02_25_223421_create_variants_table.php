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
		Schema::create('variants', function (Blueprint $table) {
			$table->id();
			$table->foreignId('product_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
			$table->string('sku')->unique();
			$table->string('name')->nullable();
			$table->string('size')->nullable();
			$table->decimal('weight', 8, 2)->nullable();
			$table->decimal('cost', 8, 2)->nullable();
			$table->decimal('price', 8, 2)->nullable();
			$table->tinyInteger('margin')->virtualAs('((price - cost) / price) * 100');
			$table->boolean('is_active')->default(true);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('variants');
	}
};
