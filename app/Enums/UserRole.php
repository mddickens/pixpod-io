<?php

namespace App\Enums;

enum UserRole: int
{
	case Admin = 0;
	case Shop = 1;

	public function label(): string
	{
		return match ($this) {
			UserRole::Admin => 'Admin',
			UserRole::Shop => 'Shop',
		};
	}

	public static function get_label(int $status): string
	{
		return match ($status) {
			UserRole::Admin->value => UserRole::Admin->label(),
			UserRole::Shop->value => UserRole::Shop->label(),
			default => 'Unknown',
		};
	}

	public static function options(): array
	{
		return [
			UserRole::Admin->value => UserRole::Admin->label(),
			UserRole::Shop->value => UserRole::Shop->label(),
		];
	}
}
