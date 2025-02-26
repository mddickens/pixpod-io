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
		Schema::create('order_requests', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
			$table->char('uid', 13)->unique();
			$table->tinyInteger('status')->nullable();
			$table->string('session_id')->nullable();
			$table->mediumText('session_json')->nullable();
			$table->mediumText('freight_quotes')->nullable();
			$table->string('payment_intent_id')->nullable();
			$table->string('tracking_no')->nullable();
			$table->string('order_id')->nullable()->index();
			$table->string('order_name')->nullable()->index();
			$table->string('request_id')->nullable()->index();
			$table->string('company')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('full_name')->virtualAs("CONCAT(first_name,' ',last_name)");
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->char('country_code', 2)->nullable();
			$table->string('phone')->nullable();
			$table->string('shipping_rate_id')->nullable();
			$table->string('shipping_service')->nullable();
			$table->decimal('product_total', 8, 2)->default(0);
			$table->decimal('discount_total', 8, 2)->default(0);
			$table->decimal('shipping_total', 8, 2)->default(0);
			$table->decimal('order_total', 10, 2)->virtualAs('product_total - discount_total + shipping_total');
			$table->dateTime('submitted_at')->nullable();
			$table->dateTime('accepted_at')->nullable();
			$table->dateTime('checkout_at')->nullable();
			$table->dateTime('in_progress_at')->nullable();
			$table->dateTime('complete_at')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('order_requests');
	}
};
