<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
	protected static ?string $model = User::class;
	protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
	protected static ?string $recordTitleAttribute = 'name';

	protected static bool $shouldRegisterNavigation = false;

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\TextInput::make('name')
					->maxLength(255)
					->required(),

				Forms\Components\TextInput::make('shop_url')->label('Shop URL')
					->maxLength(255),

				Forms\Components\TextInput::make('email')
					->maxLength(255)
					->required()
					->unique()
					->email(),

				Forms\Components\TextInput::make('password')
					->visible(fn(string $context): bool => $context === 'create')
					->dehydrateStateUsing(fn($state) => Hash::make($state))
					->revealable()
					->confirmed()
					->password()
					->required(),

				Forms\Components\TextInput::make('password_confirmation')->label('Confirm password')
					->visible(fn(string $context): bool => $context === 'create')
					->dehydrated(false)
					->revealable()
					->password()
					->required(),
			])
			->columns(3);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				Tables\Columns\TextColumn::make('name')
					->sortable(),

				Tables\Columns\TextColumn::make('is_shop')->label('Role')
					->formatStateUsing(fn($state): string => $state ? 'Shop' : 'Admin'),

				Tables\Columns\TextColumn::make('shop_url')->label('Shop URL')
					->url(fn(User $record) => "https://{$record->shop_url}")
					->openUrlInNewTab()
					->searchable()
					->sortable(),

				Tables\Columns\TextColumn::make('contact_email')
					->url(fn(User $record) => "mailto:{$record->contact_email}")
					->openUrlInNewTab()
					->searchable()
					->sortable(),
			])
			->filters([
				SelectFilter::make('is_shop')->label('Role')
					->options([
						true => 'Shop',
						false => 'Admin',
					])
					->default(true),
			])
			->actions([
				Tables\Actions\ActionGroup::make([
					Tables\Actions\EditAction::make(),
					Tables\Actions\ViewAction::make(),
					Tables\Actions\DeleteAction::make(),
				])->dropdownPlacement('bottom-start'),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			])
			->emptyStateActions([
				//
			]);
	}

	public static function infolist(Infolist $infolist): Infolist
	{
		return $infolist
			->schema([
				Components\Section::make('Shopify Detail')
					->schema([
						Components\TextEntry::make('name'),
						Components\TextEntry::make('shop_url'),
						Components\TextEntry::make('email'),
						Components\TextEntry::make('address_1'),
						Components\TextEntry::make('address_2'),
						Components\TextEntry::make('city'),
						Components\TextEntry::make('state_province'),
						Components\TextEntry::make('postal_code'),
						Components\TextEntry::make('country'),
					])
					->columns(3),

				Components\Section::make('Contact Info')
					->schema([
						Components\TextEntry::make('company_name'),
						Components\TextEntry::make('contact_name'),
						Components\TextEntry::make('contact_phone'),
						Components\TextEntry::make('contact_email'),
						Components\TextEntry::make('accounting_name'),
						Components\TextEntry::make('accounting_email'),
						Components\TextEntry::make('customer_service_email'),
						Components\TextEntry::make('customer_service_phone'),
						Components\TextEntry::make('fedex_account')->label('FedEx account'),
						Components\TextEntry::make('ups_account')->label('UPS account'),
					])->columns(4),
			]);
	}


	public static function getRelations(): array
	{
		return [
			//
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ListUsers::route('/'),
			'create' => Pages\CreateUser::route('/create'),
			'edit' => Pages\EditUser::route('/{record}/edit'),
			'view' => Pages\ViewUser::route('/{record}/view'),
		];
	}
}
