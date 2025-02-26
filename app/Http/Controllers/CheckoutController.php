<?php

namespace App\Http\Controllers;

use App\Enums\RequestStatus;
use App\Filament\Resources\OrderRequestResource;
use App\Models\OrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Stripe\StripeClient;

class CheckoutController extends Controller
{
	protected ?string $uid = null;
	protected ?object $session = null;
	protected ?string $session_id = null;

	protected ?OrderRequest $order_request = null;
	protected array $freight_quotes = [];

	public function get(Request $request)
	{
		abort_unless($request->has('session_id'), 400);

		$this->session_id = $request->get('session_id');

		$stripe = new StripeClient(getStripeSK());

		try {
			$this->session = $stripe->checkout->sessions->retrieve($this->session_id);
		} catch (\Stripe\Exception\InvalidRequestException $e) {
			info("Unable to get checkout session: " . $e->getError()->message);
			return redirect()->route('home');
		}

		if ($this->session->status == 'complete') {
			$this->uid = $this->session->metadata->uid;

			abort_unless($this->order_request = OrderRequest::firstWhere('uid', $this->uid), 404);

			try {
				$shipping_rate = $stripe->shippingRates->retrieve($this->session->shipping_cost->shipping_rate, []);
			} catch (\Stripe\Exception\InvalidRequestException $e) {
				info("Unable to get shipping rate: " . $e->getError()->message);
			}

			OrderRequest::where('uid', $this->uid)->update([
				'status' => RequestStatus::InProgress->value,
				'session_id' => $request->get('session_id'),
				'session_json' => json_encode($this->session),
				'payment_intent_id' => $this->session->payment_intent->id,
				'shipping_rate_id' => $this->session->shipping_cost->shipping_rate,
				'shipping_service' => $shipping_rate ? $shipping_rate->display_name : null,
				'discount_total' => $this->session->total_details->amount_discount / 100,
				'shipping_total' => $this->session->total_details->amount_shipping / 100,
				'checkout_at' => Carbon::now(),
				'in_progress_at' => Carbon::now(),
			]);

			show_success("Payment successful", "Your order is now in progress");

			return redirect()->route('home');
		} else {
			show_error("Payment failed", "Check your payment details and try again");
		}
	}

	public function post(string $uid)
	{
		$this->uid = $uid;

		abort_unless($this->order_request = OrderRequest::firstWhere(['uid' => $this->uid, 'status' => RequestStatus::Checkout->value,]), 403);

		$line_items = [];
		
		foreach ($this->order_request->order_request_lines as $order_request_line) {
			$line_items[] = [
				'price_data' => [
					'currency' => 'usd',
					'product' => $order_request_line->product_variant->item_variant->stripe_product_id,
					'unit_amount' => round($order_request_line->product_variant->item_variant->cost * 100, 0),
				],
				'quantity' => $order_request_line->qty,
			];
		}
		
		$shipping_options = [];
		
		if ($this->order_request->product_total >= config('pla.free_shipping_min')) {
			$shipping_options[] =	[
				'shipping_rate_data' => [
					'display_name' => "Free USPS Priority Mail",
					'fixed_amount' => [
						'amount' => 0,
						'currency' => 'usd',
					],
					'type' => 'fixed_amount',
				],
			];
		}
		
		$freight_quotes = collect(json_decode($this->order_request->freight_quotes, true));
		
		if (!empty($freight_quotes)) {
			foreach (config('pla.shipengine_ups_services') as $service_code) {
				if ($service_quote = $freight_quotes->firstWhere('service_code', $service_code)) {
					$shipping_options[] =	[
						'shipping_rate_data' => [
							'display_name' => $service_quote['service'],
							'fixed_amount' => [
								'amount' => round($service_quote['charge_amount'] * 100, 0),
								'currency' => 'usd',
							],
							'type' => 'fixed_amount',
						],
					];
				}
			}
		}

		$stripe = new StripeClient(getStripeSK());
		
		try {
			$session = $stripe->checkout->sessions->create([
				'mode' => 'payment',
				'ui_mode' => 'embedded',
				'line_items' => $line_items,
				'metadata' => [
					'uid' => $this->uid,
				],
				'consent_collection' => [
					'promotions' => 'auto',
				],
				'billing_address_collection' => 'required',
				'shipping_options' => $shipping_options,
				'return_url' => config('app.url') . "/api/checkout?session_id={CHECKOUT_SESSION_ID}",
				'expand' => [
					'customer',
					'payment_intent',
				],
			]);
		} catch (\Stripe\Exception\InvalidRequestException $e) {
			info("Unable to create checkout session: " . $e->getError()->message);
			return redirect(OrderRequestResource::getUrl('index'));
		}
		
		return response()->json([
			'clientSecret' => $session->client_secret,
		]);
	}
}
