<?php

namespace App\Providers;

use Filament\Support\View\Components\Modal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	public $singletons = [
		\Filament\Http\Responses\Auth\Contracts\LoginResponse::class => \App\Http\Responses\LoginResponse::class,
		\Filament\Http\Responses\Auth\Contracts\LogoutResponse::class => \App\Http\Responses\LogoutResponse::class,
	];

	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		Model::unguard();
		Modal::closedByClickingAway(false);

		Blade::directive('filled', function ($var) {
			return "<?php if (isset($var) && filled($var)): ?>";
		});

		Blade::directive('endfilled', function () {
			return "<?php endif; ?>";
		});
	}
}
