<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('get_shipengine_key')) {
	function get_shipengine_key()
	{
		return config('pla.shipengine_is_test_mode') ? config('pla.shipengine_test_key') : config('pla.shipengine_live_key');
	}
}

if (!function_exists('shipengine_get')) {
	function shipengine_get(string $path, ?array $data = null)
	{
		return Http::timeout(config('pla.shipengine_timeout'))->withHeaders(['API-Key' => get_shipengine_key(), 'Host' => 'api.shipengine.com',])->get(config('pla.shipengine_endpoint') . "/$path", $data);
	}
}

if (!function_exists('shipengine_post')) {
	function shipengine_post(string $path, ?array $data = null)
	{
		return Http::timeout(config('pla.shipengine_timeout'))->withHeaders(['API-Key' => get_shipengine_key(), 'Host' => 'api.shipengine.com',])->post(config('pla.shipengine_endpoint') . "/$path", $data);
	}
}

if (!function_exists('shipengine_put')) {
	function shipengine_put(string $path, ?array $data = null)
	{
		return Http::timeout(config('pla.shipengine_timeout'))->withHeaders(['API-Key' => get_shipengine_key(), 'Host' => 'api.shipengine.com',])->put(config('pla.shipengine_endpoint') . "/$path", $data);
	}
}

if (!function_exists('shipengine_estimates')) {
	function shipengine_estimates(string $to_city, string $to_state_province, string $to_zip_postal_code, string $to_country_code, int $package_count, int $weight): array
	{
		$response = shipengine_post('rates/estimate', [
			'carrier_id' => config('pla.shipengine_ups_carrier_id'),
			'from_city_locality' => config('pla.city'),
			'from_state_province' => config('pla.state_code'),
			'from_postal_code' => config('pla.postal_code'),
			'from_country_code' => config('pla.country_code'),
			'to_city_locality' => $to_city,
			'to_state_province' => $to_state_province,
			'to_postal_code' => $to_country_code == config('pla.domestic_iso2_code') ? substr(preg_replace('/[^0-9]/', '', $to_zip_postal_code), 0, 5)  : $to_zip_postal_code,
			'to_country_code' => $to_country_code,
			'weight' => [
				'value' => $weight,
				'unit' => 'pound'
			],
			'confirmation' => 'none',
			'address_residential_indicator' => 'yes',
			'ship_date' => now()->toAtomString(),
		]);

		if ($response->successful()) {
			$freight_quotes = [];

			$estimates = json_decode($response->body());

			foreach ($estimates as $estimate) {
				if ($estimate->validation_status != 'valid' && !empty($estimate->error_messages)) {
					info("Unable to estimate freight charges: {$estimate->error_messages[0]}");
					return [];
				} else {
					$freight_quotes[] = [
						'service' => $estimate->service_type,
						'service_code' => $estimate->service_code,
						'estimate_amount' => $estimate->shipping_amount->amount,
						'charge_amount' => round($estimate->shipping_amount->amount * config('pla.freight_charge_markup_multiplier') * $package_count, 2),
					];
				}
			}

			return $freight_quotes;
		} else {
			info("Unable to estimate freight charges. Status code: " . $response->status());
			return [];
		}
	}
}

if (!function_exists('shipengine_validate_address')) {
	function shipengine_validate_address($address_line_1, $address_line_2, $city, $state_province, $zip_postal_code, $country_code): null | string
	{
		$response = shipengine_post('addresses/validate', [
			[
				'address_line1' => $address_line_1,
				'address_line2' => $address_line_2,
				'city_locality' => $city,
				'state_province' => $state_province,
				'postal_code' => $zip_postal_code,
				'country_code' => $country_code,
			]
		]);

		if ($response->successful()) {
			return $response->body();
		} else {
			info("Address validation failed. HTTP status: " . $response->status());
			return null;
		}
	}
}
