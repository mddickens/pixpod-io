<?php

use App\Models\CountryCode;
use App\Models\PayMethod;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

if (!function_exists('a2o')) {
	function a2o($data)
	{
		return json_decode(json_encode($data));
	}
}

if (!function_exists('o2a')) {
	function o2a($data)
	{
		return json_decode(json_encode($data), true);
	}
}

if (!function_exists('is_shop')) {
	function is_shop()
	{
		return Auth::user()->is_shop;
	}
}

if (!function_exists('is_admin')) {
	function is_admin()
	{
		return !Auth::user()->is_shop;
	}
}

if (!function_exists('getStripeSK')) {
	function getStripeSK()
	{
		return config('pla.stripe_is_test_mode') ? config('pla.stripe_test_secret_key') : config('pla.stripe_live_secret_key');
	}
}

if (!function_exists('getStripePK')) {
	function getStripePK()
	{
		return config('pla.stripe_is_test_mode') ? config('pla.stripe_test_public_key') : config('pla.stripe_live_public_key');
	}
}

if (!function_exists('getStripeWHChargeSecret')) {
	function getStripeWHChargeSecret()
	{
		return config('pla.stripe_is_test_mode') ? config('pla.stripe_test_webhook_charge_secret') : config('pla.stripe_live_webhook_charge_secret');
	}
}

if (!function_exists('getStripeWHRefundSecret')) {
	function getStripeWHRefundSecret()
	{
		return config('pla.stripe_is_test_mode') ? config('pla.stripe_test_webhook_refund_secret') : config('pla.stripe_live_webhook_refund_secret');
	}
}

if (!function_exists('makeTitleCase')) {
	function makeTitleCase($strIn, $needle = '_')
	{
		return ucwords(strtolower(str_replace($needle, ' ', $strIn)));
	}
}

if (!function_exists('show_success')) {
	function show_success($title, $body = null)
	{
		Notification::make()
			->title($title)
			->body($body)
			->success()
			->send();
	}
}

if (!function_exists('show_error')) {
	function show_error($title, $body = null)
	{
		Notification::make()
			->title($title)
			->body($body)
			->color('danger')
			->persistent()
			->danger()
			->send();
	}
}

if (!function_exists('getMonthOptions')) {
	function getMonthOptions($default = 0)
	{
		$optStr = '';
		$months = ['01-Jan', '02-Feb', '03-Mar', '04-Apr', '05-May', '06-Jun', '07-Jul', '08-Aug', '09-Sep', '10-Oct', '11-Nov', '12-Dec'];

		$def_month = $default == 0 ? intval(date('n')) : $default;

		for ($i = 1; $i < 13; ++$i) {
			$selected = $i == $def_month ? ' selected' : '';
			$optStr .= "<option value=\"$i\"$selected>{$months[$i - 1]}</option>";
		}

		return $optStr;
	}
}

if (!function_exists('getYearOptions')) {
	function getYearOptions($default = 0)
	{
		$optStr = '';
		$start = intval(date('Y'));
		$def_year = $default == 0 ? $start : $default;

		for ($i = $start; $i < $start + 10; ++$i) {
			$selected = $i == $def_year ? ' selected' : '';
			$optStr .= "<option value=\"$i\"$selected>$i</option>";
		}

		return $optStr;
	}
}

if (!function_exists('getCountryOptions')) {
	function getCountryOptions($default = 'US', $restrict = true)
	{
		$options = '';

		if ($restrict) {
			$codes = DB::table('country_codes')->where('is_active', true)->orderBy('name')->get();
		} else {
			$codes = DB::table('country_codes')->orderBy('name')->get();
		}

		foreach ($codes as $code) {
			$selected = $default == $code->iso_2 ? ' selected="selected"' : '';
			$options .= "<option value=\"{$code->iso_2}\"$selected>{$code->name}</option>";
		}

		return $options;
	}
}
