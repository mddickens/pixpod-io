<?php

namespace App\Models;

use App\Enums\UserRole;
use Filament\Panel;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Stripe\StripeClient;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
	use Notifiable;

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'verified_at' => 'datetime',
		'activated_at' => 'datetime',
	];

	public function canAccessPanel(Panel $panel): bool
	{
		return str::lower(UserRole::get_label($this->role)) == $panel->getId();
	}

	public function order_requests()
	{
		return $this->hasMany(OrderRequest::class);
	}

	public function add_to_stripe()
	{
		if (empty($this->stripe_id)) {
			$stripe = new StripeClient(getStripeSK());

			try {
				$respStripe = $stripe->customers->create([
					'name' => $this->name,
					'email' => $this->email,
					'description' => $this->shop_url,
					'address' => [
						'line1' => $this->address_1,
						'line2' => $this->address_2,
						'city' => $this->city,
						'state' => $this->state_province,
						'postal_code' => $this->postal_code,
						'country' => $this->country,
					],
				]);

				$this->update([
					'stripe_id' => $respStripe->id,
				]);
			} catch (\Stripe\Exception\InvalidRequestException $e) {
				AppLog::log_it(__FILE__, 'add_to_stripe() failed: ' . $e->getError()->message, $this->id);
			}
		}
	}

	public function delete_from_stripe()
	{
		if (!empty($this->stripe_id)) {
			$stripe = new StripeClient(getStripeSK());

			try {
				$stripe->customers->delete(
					$this->stripe_id,
					[]
				);

				$this->update([
					'stripe_id' => null,
				]);
			} catch (\Stripe\Exception\InvalidRequestException $e) {
				AppLog::log_it(__FILE__, 'delete_from_stripe() failed: ' . $e->getError()->message, $this->id);
			}
		}
	}
}
