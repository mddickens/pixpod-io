<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Register;
use App\Http\Middleware\RedirectToProperPanelMiddleware;
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

class AdminPanelProvider extends PanelProvider
{
	public function panel(Panel $panel): Panel
	{
		return $panel
			->default()
			->id('admin')
			->path('admin')
			->login()
			->colors([
				'primary' => Color::Emerald,
			])
			->navigationItems([
				NavigationItem::make('Order Requests')
					->url(config('app.url') . '/admin/order-requests')
					->icon('heroicon-o-truck')
					//->visible(fn() => is_shop())
					->sort(0),

				NavigationItem::make('Contact Info')
					->url(config('app.url') . '/admin/shop-contact')
					->icon('heroicon-o-truck')
					//->visible(fn() => is_shop())
					->sort(1),

				NavigationItem::make('Orders')
					->url(config('app.url') . '/admin/order-requests')
					//->visible(fn() => is_admin())
					->icon('heroicon-o-truck')
					->sort(0),

				NavigationItem::make('Products')
					->url(config('app.url') . '/admin/products')
					->icon('heroicon-o-cube')
					//->visible(fn() => is_admin())
					->sort(1),

				NavigationItem::make('Variants')
					->url(config('app.url') . '/admin/variants')
					->icon('heroicon-o-cube')
					//->visible(fn() => is_admin())
					->sort(2),

				NavigationItem::make('Categories')
					->url(config('app.url') . '/admin/categories')
					->icon('heroicon-o-list-bullet')
					//->visible(fn() => is_admin())
					->sort(3),

				NavigationItem::make('Pages')
					->url(config('app.url') . '/admin/pages')
					->icon('heroicon-o-list-bullet')
					//->visible(fn() => is_admin())
					->sort(4),

				NavigationItem::make('Users')
					->url(config('app.url') . '/admin/users')
					->icon('heroicon-o-list-bullet')
					//->visible(fn() => is_admin())
					->sort(5),

				NavigationItem::make('FAQs')
					->url(config('app.url') . '/admin/faq-categories')
					->icon('heroicon-o-list-bullet')
					//->visible(fn() => is_admin())
					->sort(6),
			])
			->profile()
			->registration(Register::class)
			->passwordReset()
			->emailVerification()
			->brandLogoHeight('3rem')
			->brandLogo(asset('img/logo.svg'))
			->favicon(asset('img/favicon.png'))
			->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
			->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
			->pages([
				Pages\Dashboard::class,
			])
			->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
			->widgets([
				Widgets\AccountWidget::class,
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
				RedirectToProperPanelMiddleware::class,
				Authenticate::class,
			])
			->renderHook(PanelsRenderHook::HEAD_END, fn(): string => Blade::render('<script src="https://js.stripe.com/v3/"></script>'));
	}
}
