<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use App\Mail\OrderNotification;
use App\Models\Distributor;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function get(Request $request, $id = 0)
	{
		abort_unless(($api_key = $request->header('X-API-KEY')) && ($distributor = Distributor::firstWhere('uid', $api_key)), 401);
		
		$payload = json_decode(@file_get_contents('php://input'));
		
		info('GET request: ' . json_encode($payload, JSON_PRETTY_PRINT));
		
		http_response_code(200);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function post(Request $request)
	{
		abort_unless(($api_key = $request->header('X-API-KEY')) && ($distributor = Distributor::firstWhere('uid', $api_key)), 401);

		$payload = json_decode(@file_get_contents('php://input'));

		abort_unless(isset($payload->order), 401);

		SendMail::dispatch(config('pla.orders_email'), config('pla.orders_name'), $distributor->user->email, $distributor->user->name, "Order Notification from Order Desk", (new OrderNotification($distributor->id, $payload->order))->render());
//		SendMail::dispatch('mark@precisioncrystal.com', 'Mark Dickens', $distributor->user->email, $distributor->user->name, "Order Notification from Order Desk", (new OrderNotification($distributor->id, $payload->order))->render());

		http_response_code(200);
	}
}
