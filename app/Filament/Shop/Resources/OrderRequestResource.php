<?php

namespace App\Filament\Shop\Resources;

use App\Enums\RequestStatus;
use App\Filament\Shop\Resources\OrderRequestResource\Pages;
use App\Models\OrderRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class OrderRequestResource extends Resource
{
	protected static ?string $model = OrderRequest::class;

	protected static ?string $recordTitleAttribute = 'order_name';

	protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static bool $shouldRegisterNavigation = false;

	public static function getGloballySearchableAttributes(): array
	{
		return [
			'order_name',
			'last_name',
		];
	}

	public static function getGlobalSearchResultDetails(Model $record): array
	{
		return [
			'Customer' => $record->full_name,
			'Order Total' => $record->order_total,
			'Status' => RequestStatus::get_label($record->status),
		];
	}

	public static function getGlobalSearchResultUrl(Model $record): string
	{
		return OrderRequestResource::getUrl('view', ['record' => $record]);
	}

	public static function form(Form $form): Form
	{
		if (is_admin()) {
			return $form
				->schema([
					Forms\Components\Section::make('Address Information')
						->schema([
							Forms\Components\Placeholder::make('order')
								->content(fn(OrderRequest $record): string => $record->order_name),

							Forms\Components\Select::make('status')
								->disabled(fn(OrderRequest $record): bool => $record->status == RequestStatus::Complete->value)
								->options(RequestStatus::options()),

							Forms\Components\TextInput::make('first_name')
								->disabled(fn(OrderRequest $record): bool => $record->status != RequestStatus::Checkout->value),

							Forms\Components\TextInput::make('last_name')
								->disabled(fn(OrderRequest $record): bool => $record->status != RequestStatus::Checkout->value),

							Forms\Components\TextInput::make('company')
								->disabled(fn(OrderRequest $record): bool => $record->status != RequestStatus::Checkout->value),

							Forms\Components\TextInput::make('address1')->label('Street address')
								->disabled(fn(OrderRequest $record): bool => $record->status != RequestStatus::Checkout->value),

							Forms\Components\TextInput::make('address2')->label('Suite, floor, apartment')
								->disabled(fn(OrderRequest $record): bool => $record->status != RequestStatus::Checkout->value),

							Forms\Components\TextInput::make('city')
								->disabled(fn(OrderRequest $record): bool => $record->status != RequestStatus::Checkout->value),

							Forms\Components\TextInput::make('state')->label('State or province')
								->disabled(fn(OrderRequest $record): bool => $record->status != RequestStatus::Checkout->value),

							Forms\Components\TextInput::make('zip')->label('Zip or postal code')
								->disabled(fn(OrderRequest $record): bool => $record->status != RequestStatus::Checkout->value),

							Forms\Components\TextInput::make('country_code')
								->disabled(fn(OrderRequest $record): bool => $record->status != RequestStatus::Checkout->value),

							Forms\Components\TextInput::make('phone')
								->disabled(fn(OrderRequest $record): bool => $record->status != RequestStatus::Checkout->value),
						])
						->columns(4),
				]);
		} else {
			return $form
				->schema([
					Forms\Components\Section::make('Address Information')
						->schema([
							Forms\Components\Placeholder::make('order')
								->content(fn(OrderRequest $record): string => $record->order_name),

							Forms\Components\Placeholder::make('status')
								->content(fn(OrderRequest $record): string => RequestStatus::get_label($record->status))
								->columnSpan(2),

							Forms\Components\Placeholder::make('name')
								->content(fn(OrderRequest $record): string => $record->full_name),

							Forms\Components\Placeholder::make('company')
								->content(fn(OrderRequest $record): ?string => $record->company),

							Forms\Components\Placeholder::make('street_address')
								->content(fn(OrderRequest $record): string => $record->address1),

							Forms\Components\Placeholder::make('suite, floor, apartment')
								->content(fn(OrderRequest $record): ?string => $record->address2),

							Forms\Components\Placeholder::make('city')
								->content(fn(OrderRequest $record): string => $record->city),

							Forms\Components\Placeholder::make('state_or_province')
								->content(fn(OrderRequest $record): string => $record->state),

							Forms\Components\Placeholder::make('zip_or_postal_code')
								->content(fn(OrderRequest $record): string => $record->zip),

							Forms\Components\Placeholder::make('country')
								->content(fn(OrderRequest $record): string => $record->country_code),

							Forms\Components\Placeholder::make('phone')
								->content(fn(OrderRequest $record): string => $record->phone),
						])
						->columns(3),
				]);
		}
	}

	public static function table(Table $table): Table
	{
		if (is_admin()) {
			return $table
				->columns([
					Tables\Columns\TextColumn::make('user_id')->label('Shop')
						->formatStateUsing(fn(OrderRequest $record): string => $record->user->name)
						->limit(30),

					Tables\Columns\TextColumn::make('status')
						->formatStateUsing(fn($state): string => RequestStatus::get_label($state)),

					Tables\Columns\TextColumn::make('order_name')->label('Order')
						->searchable()
						->sortable(),

					Tables\Columns\TextColumn::make('full_name')->label('Name')
						->searchable()
						->sortable(),

					Tables\Columns\TextColumn::make('product_total')
						->formatStateUsing(fn($state): string => '$' . number_format($state, 2))
						->alignRight(),

					Tables\Columns\TextColumn::make('shipping_total')
						->formatStateUsing(fn($state): string => '$' . number_format($state, 2))
						->alignRight(),

					Tables\Columns\TextColumn::make('order_total')
						->formatStateUsing(fn($state): string => '$' . number_format($state, 2))
						->alignRight(),

					Tables\Columns\TextColumn::make('submitted_at')
						->alignCenter(),
				])
				->filters([
					SelectFilter::make('status')
						->options(RequestStatus::options()),
				])
				->actions([
					Tables\Actions\ActionGroup::make([
						Tables\Actions\EditAction::make()
							->visible(fn(OrderRequest $record): bool => $record->status == RequestStatus::Checkout->value),

						Tables\Actions\Action::make('complete_order')
							->visible(fn(OrderRequest $record): bool => $record->status == RequestStatus::InProgress->value)
							->action(fn(OrderRequest $record, array $data) => $record->complete_request($data['tracking_number']))
							->form([
								Forms\Components\TextInput::make('tracking_number')
									->maxLength(255)
									->required(),
							])
							->modalWidth('md')
							->icon('heroicon-o-bolt'),
					])->dropdownPlacement('bottom-start'),
				])
				->bulkActions([
					Tables\Actions\BulkActionGroup::make([
						Tables\Actions\DeleteBulkAction::make(),
					]),
				])
				->emptyStateHeading('No order requests')
				->paginated([25, 25, 50, 100, 'all'])
				->persistFiltersInSession();
		} else {
			return $table
				->columns([
					Tables\Columns\TextColumn::make('order_name')->label('Order')
						->searchable()
						->sortable(),

					Tables\Columns\TextColumn::make('status')
						->formatStateUsing(fn($state): string => RequestStatus::get_label($state)),

					Tables\Columns\TextColumn::make('full_name')->label('Name')
						->searchable()
						->sortable(),

					Tables\Columns\TextColumn::make('product_total')
						->formatStateUsing(fn($state): string => '$' . number_format($state, 2))
						->alignRight(),

					Tables\Columns\TextColumn::make('shipping_total')
						->formatStateUsing(fn($state): string => '$' . number_format($state, 2))
						->alignRight(),

					Tables\Columns\TextColumn::make('order_total')
						->formatStateUsing(fn($state): string => '$' . number_format($state, 2))
						->alignRight(),

					Tables\Columns\TextColumn::make('submitted_at')
						->alignCenter(),

					Tables\Columns\TextColumn::make('complete_at')
						->alignCenter(),
				])
				->filters([
					SelectFilter::make('status')
						->options(RequestStatus::options()),
				])
				->actions([
					Tables\Actions\ActionGroup::make([
						Tables\Actions\ViewAction::make(),

						Tables\Actions\Action::make('checkout')
							->visible(fn(OrderRequest $record): bool => $record->status == RequestStatus::Checkout->value)
							->url(fn(OrderRequest $record) => OrderRequestResource::getUrl('checkout', ['record' => $record,]))
							->icon('heroicon-o-credit-card'),
					])->dropdownPlacement('bottom-start'),
				])
				->bulkActions([])
				->emptyStateHeading('No order requests')
				->paginated([25, 25, 50, 100, 'all'])
				->persistFiltersInSession();
		}
	}

	public static function infolist(Infolist $infolist): Infolist
	{
		return $infolist
			->schema([
				Components\Section::make('Shipping Address')
					->schema([
						Components\TextEntry::make('full_name')->label('Name'),

						Components\TextEntry::make('company'),

						Components\TextEntry::make('address1')->label('Street address'),

						Components\TextEntry::make('address2')->label('Suite, floor, apartment'),

						Components\TextEntry::make('city'),

						Components\TextEntry::make('state')->label('State or province'),

						Components\TextEntry::make('zip')->label('Zip or postal code'),

						Components\TextEntry::make('country_code'),

						Components\TextEntry::make('phone'),
					])
					->columns(3),

				Components\Section::make('Order items')
					->schema([
						Components\RepeatableEntry::make('order_request_lines')->label('')
							->schema([
								Components\TextEntry::make('qty')
									->numeric(),

								Components\TextEntry::make('sku')->label('SKU'),

								Components\TextEntry::make('product_variant.name')->label('Description'),

								Components\TextEntry::make('cost')
									->money(),

								Components\TextEntry::make('line_total')->label('Total')
									->money(),

								Components\ImageEntry::make('image')
									->defaultImageUrl(fn(Model $record): string => $record->getFirstMediaUrl('orders'))
									->height(100)
									->width(100),
							])
							->columns(6)
					]),

				Components\Section::make('Order Totals')
					->schema([
						Components\TextEntry::make('product_total')
							->money(),

						Components\TextEntry::make('shipping_total')
							->money(),

						Components\TextEntry::make('order_total')
							->money(),

						Components\TextEntry::make('payment_intent_id')->label('Stripe payment id'),
					])
					->columns(4),

				Components\Section::make('Order History')
					->schema([
						Components\TextEntry::make('submitted_at'),

						Components\TextEntry::make('accepted_at'),

						Components\TextEntry::make('checkout_at'),

						Components\TextEntry::make('complete_at')->label('Completed at'),

						Components\TextEntry::make('shipping_service')->label('Shipped via'),

						Components\TextEntry::make('tracking_no')->label('Tracking number'),
					])
					->columns(3),
			]);
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ListOrderRequests::route('/'),
			'create' => Pages\CreateOrderRequest::route('/create'),
			'edit' => Pages\EditOrderRequest::route('/{record}/edit'),
			'view' => Pages\ViewOrderRequest::route('/{record}/view'),
			'checkout' => Pages\Checkout::route('/{record}/checkout'),
		];
	}
}
