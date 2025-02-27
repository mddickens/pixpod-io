<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ShopPanelProvider extends PanelProvider
{
	public function panel(Panel $panel): Panel
	{
		return $panel
			->id('shop')
			->path('shop')
			->colors([
				'primary' => Color::Emerald,
			])
			->navigationItems([
				NavigationItem::make('Orders')
					->url(config('app.url') . '/shop/order-requests')
					->icon('heroicon-o-truck')
					->sort(0),

				NavigationItem::make('Products')
					->url(config('app.url') . '/shop/products')
					->icon('heroicon-o-cube')
					->sort(1),

				NavigationItem::make('Contact Info')
					->url(config('app.url') . '/shop/shop-contact')
					->icon('heroicon-o-truck')
					->sort(2),
			])
			->profile()
			->passwordReset()
			->emailVerification()
			->brandLogoHeight('3rem')
			->brandLogo(asset('img/logo.svg'))
			->discoverResources(in: app_path('Filament/Shop/Resources'), for: 'App\\Filament\\Shop\\Resources')
			->discoverPages(in: app_path('Filament/Shop/Pages'), for: 'App\\Filament\\Shop\\Pages')
			->pages([
				Pages\Dashboard::class,
			])
			->discoverWidgets(in: app_path('Filament/Shop/Widgets'), for: 'App\\Filament\\Shop\\Widgets')
			->widgets([
				Widgets\AccountWidget::class,
				Widgets\FilamentInfoWidget::class,
			])
			->middleware([
				EncryptCookies::class,
				AddQueuedCookiesToResponse::class,
				StartSession::class,
				AuthenticateSession::class,
				ShareErrorsFromSession::class,
				VerifyCsrfToken::class,
				SubstituteBindings::class,
				DisableBladeIconComponents::class,
				DispatchServingFilamentEvent::class,
			])
			->authMiddleware([
				Authenticate::class,
			])
			->renderHook(PanelsRenderHook::HEAD_END, fn(): string => Blade::render('<script src="https://js.stripe.com/v3/"></script>'));
	}
}
