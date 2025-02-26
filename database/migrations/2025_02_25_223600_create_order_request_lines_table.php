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
		Schema::create('order_request_lines', function (Blueprint $table) {
			$table->id();
			$table->foreignId('order_request_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
			$table->string('line_item_id')->nullable()->index();
			$table->smallInteger('qty')->unsigned();
			$table->string('sku')->index();
			$table->decimal('cost', 8, 2);
			$table->decimal('line_total', 8, 2)->virtualAs('qty * cost');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('order_request_lines');
	}
};
