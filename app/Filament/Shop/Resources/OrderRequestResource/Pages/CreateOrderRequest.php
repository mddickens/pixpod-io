<?php

namespace App\Filament\Shop\Resources\OrderRequestResource\Pages;

use App\Filament\Resources\OrderRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrderRequest extends CreateRecord
{
	protected static string $resource = OrderRequestResource::class;
}
