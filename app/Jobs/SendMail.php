<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Socketlabs\SocketLabsClient;
use Socketlabs\Message\BasicMessage;
use Socketlabs\Message\EmailAddress;

class SendMail implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public $to;
	public $to_name;
	public $from;
	public $from_name;
	public $subject;
	public $html_body;
	public $text_body;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($to, $to_name, $from, $from_name, $subject, $html_body, $text_body = '')
	{
		$this->to = $to;
		$this->to_name = $to_name;
		$this->from = $from;
		$this->from_name = $from_name;
		$this->subject = $subject;
		$this->html_body = $html_body;
		$this->text_body = $html_body;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		$message = new BasicMessage();

		$client = new SocketLabsClient(config('pla.socketlabs_server'), config('pla.socketlabs_api_key'));

		$message->to[] = new EmailAddress($this->to, $this->to_name);
		$message->from = new EmailAddress($this->from, $this->from_name);
		$message->subject = $this->subject;
		$message->htmlBody = $this->html_body;
		$message->plainTextBody = $this->text_body;

		$response = $client->send($message);

		if ($response->result != 'Success') {
			Log::error("Email failed - To: {$this->to}, From: {$this->from}, Subject: {$this->subject}, Error: {$response->result}");
		}
	}
}
