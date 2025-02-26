<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use Filament\Pages\Dashboard;
use Closure;

class RedirectToProperPanelMiddleware
{
	public function handle(Request $request, Closure $next)
	{
		if (auth()->check() && auth()->user()->role == UserRole::Shop->value) {
			return redirect()->to(Dashboard::getUrl(panel: 'shop'));
		}
		return $next($request);
	}
}
