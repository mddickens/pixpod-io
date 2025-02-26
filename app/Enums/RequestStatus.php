<?php

namespace App\Enums;

enum RequestStatus: int
{
	case Checkout = 0;
	case InProgress = 1;
	case Complete = 2;

	public function label(): string
	{
		return match ($this) {
			RequestStatus::Checkout => 'Checkout',
			RequestStatus::InProgress => 'In Progress',
			RequestStatus::Complete => 'Complete',
		};
	}

	public static function get_label(int $status): string
	{
		return match ($status) {
			RequestStatus::Checkout->value => RequestStatus::Checkout->label(),
			RequestStatus::InProgress->value => RequestStatus::InProgress->label(),
			RequestStatus::Complete->value => RequestStatus::Complete->label(),
			default => 'Unknown',
		};
	}

	public static function options(): array
	{
		return [
			RequestStatus::Checkout->value => RequestStatus::Checkout->label(),
			RequestStatus::InProgress->value => RequestStatus::InProgress->label(),
			RequestStatus::Complete->value => RequestStatus::Complete->label(),
		];
	}
}
