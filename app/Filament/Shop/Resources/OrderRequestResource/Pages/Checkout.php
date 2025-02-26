<?php

namespace App\Filament\Shop\Resources\OrderRequestResource\Pages;

use App\Enums\RequestStatus;
use App\Filament\Resources\OrderRequestResource;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class Checkout extends Page
{
	use InteractsWithRecord;

	protected static string $resource = OrderRequestResource::class;

	protected static string $view = 'filament.resources.order-request-resource.pages.checkout';

	public function mount(int | string $record): void
	{
		$this->record = $this->resolveRecord($record);

		if ($this->record->user_id != auth()->id() || $this->record->status != RequestStatus::Checkout->value) {
			abort(403);
		}
	}
}
