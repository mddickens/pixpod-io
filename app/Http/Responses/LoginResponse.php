<?php

namespace App\Http\Responses;

use App\Enums\UserRole;
use Filament\Pages\Dashboard;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;
use Filament\Http\Responses\Auth\LoginResponse as BaseLoginResponse;

class LoginResponse extends BaseLoginResponse
{
	public function toResponse($request): RedirectResponse | Redirector
	{
		if (auth()->user()->role == UserRole::Shop->value) {
			return redirect()->to(Dashboard::getUrl(panel: 'shop'));
		}

		return parent::toResponse($request);
	}
}
