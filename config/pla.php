<?php

return [
	'contact' => 'Shipping Manager',
	'company' => 'Precision Laser Art LLC',
	'street' => '7933 Stage Hills Blvd',
	'city' => 'Bartlett',
	'state_code' => 'TN',
	'postal_code' => '38133',
	'country_code' => 'US',
	'toll_free_phone' => '866-716-0300',
	'fax_phone' => '901-328-1498',

	'socketlabs_server' => env('SOCKETLABS_SERVER'),
	'socketlabs_api_key' => env('SOCKETLABS_API_KEY'),

	'no_image_url' => 'https://pixpod.io/img/no_image.png',

	'order_to_address' => 'mark@pixveria.com',
	'support_to_address' => 'mark@pixveria.com',
	'accounting_to_address' => 'mark@pixveria.com',

	'stripe_is_test_mode' => true,

	'stripe_test_public_key' => env('STRIPE_TEST_PUBLIC_KEY'),
	'stripe_test_secret_key' => env('STRIPE_TEST_SECRET_KEY'),

	'stripe_live_public_key' => env('STRIPE_LIVE_PUBLIC_KEY'),
	'stripe_live_secret_key' => env('STRIPE_LIVE_SECRET_KEY'),

	'freight_charge_markup_multiplier' => 1.15,
	'packaging_multiplier' => 1.05,
	'packing_weight_multiplier' => 1.15,
	'max_package_weight' => 40.0,
	'free_shipping_min' => 79.00,

	'shipengine_is_test_mode' => false,
	'shipengine_test_key' => env("SHIPENGINE_TEST_KEY"),
	'shipengine_live_key' => env("SHIPENGINE_LIVE_KEY"),
	'shipengine_endpoint' => 'https://api.shipengine.com/v1',
	'shipengine_warehouse_id' => 'se-11852016',
	'shipengine_timeout' => 300,

	'shipengine_ups_carrier_id' => 'se-5350379',

	'shipengine_ups_services' => [
		'ups_ground',
		'ups_3_day_select',
		'ups_2nd_day_air',
		'ups_next_day_air',
	],
];
