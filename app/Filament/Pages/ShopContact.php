<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Forms;
use Filament\Pages\Page;

class ShopContact extends Page
{
	protected static ?string $navigationIcon = 'heroicon-o-document-text';
	protected static string $view = 'filament.pages.shop-contact';
	protected static bool $shouldRegisterNavigation = false;

	public ?User $shop = null;

	public ?string $company_name = null;
	public ?string $contact_name = null;
	public ?string $contact_phone = null;
	public ?string $contact_email = null;
	public ?string $accounting_name = null;
	public ?string $accounting_email = null;
	public ?string $customer_service_email = null;
	public ?string $customer_service_phone = null;
	public ?string $fedex_account = null;
	public ?string $ups_account = null;

	public static function canAccess(): bool
	{
		return is_shop();
	}

	public function getMaxContentWidth(): ?string
	{
		return '7xl';
	}

	public static function getNavigationLabel(): string
	{
		return 'Contact Info';
	}

	public function getTitle(): string
	{
		return 'Contact Info';
	}

	protected function getFormSchema(): array
	{
		return [
			Forms\Components\Section::make('Contact Information')
				->schema([
					Forms\Components\TextInput::make('company_name')
						->maxLength(255),

					Forms\Components\TextInput::make('contact_name')
						->maxLength(255)
						->required(),

					Forms\Components\TextInput::make('contact_phone')
						->maxLength(255)
						->required()
						->tel(),

					Forms\Components\TextInput::make('contact_email')
						->maxLength(255)
						->required()
						->email(),

					Forms\Components\TextInput::make('accounting_name')
						->helperText('Receipts and other accounting related communications will go to this contact')
						->maxLength(255),

					Forms\Components\TextInput::make('accounting_email')
						->maxLength(255)
						->email(),

					Forms\Components\TextInput::make('customer_service_email')
						->helperText('If provided, this will be printed on your shipping label')
						->email(),

					Forms\Components\TextInput::make('customer_service_phone')
						->helperText('If provided, this will be printed on your shipping label')
						->maxLength(255)
						->tel(),

					Forms\Components\TextInput::make('fedex_account')->label('FedEx account')
						->helperText('Used in the case where you want expedited shipping charged to your account'),

					Forms\Components\TextInput::make('ups_account')->label('UPS account')
						->helperText('Used in the case where you want expedited shipping charged to your account'),
				])
				->columns(2)
				->label('Contact Info'),
		];
	}

	public function mount(): void
	{
		$this->shop = auth()->user();

		$this->company_name = $this->shop->company_name ?? $this->shop->name;
		$this->contact_name = $this->shop->contact_name;
		$this->contact_phone = $this->shop->contact_phone;
		$this->contact_email = $this->shop->contact_email ?? $this->shop->email;
		$this->accounting_name = $this->shop->accounting_name;
		$this->accounting_email = $this->shop->accounting_email;
		$this->customer_service_email = $this->shop->customer_service_email;
		$this->customer_service_phone = $this->shop->customer_service_phone;
		$this->fedex_account = $this->shop->fedex_account;
		$this->ups_account = $this->shop->ups_account;
	}

	public function submit()
	{
		$this->shop->update([
			'company_name' => $this->company_name,
			'contact_name' => $this->contact_name,
			'contact_phone' => $this->contact_phone,
			'contact_email' => $this->contact_email,
			'accounting_name' => $this->accounting_name,
			'accounting_email' => $this->accounting_email,
			'customer_service_email' => $this->customer_service_email,
			'customer_service_phone' => $this->customer_service_phone,
			'fedex_account' => $this->fedex_account,
			'ups_account' => $this->ups_account,
		]);

		return redirect('/admin');
	}
}
