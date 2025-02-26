<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VariantResource\Pages;
use App\Models\Product;
use App\Models\Variant;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VariantResource extends Resource
{
	protected static ?string $model = Variant::class;

	protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static bool $shouldRegisterNavigation = false;

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\Select::make('item_id')->label('Item')
					->options(fn() => Product::where('is_active', true)->pluck('name', 'id'))
					->required()
					->preload(),

				Forms\Components\TextInput::make('sku')
					->unique(ignoreRecord: true)
					->maxLength(255)
					->required(),

				Forms\Components\TextInput::make('name')
					->maxLength(255)
					->required(),

				Forms\Components\TextInput::make('size')
					->maxLength(255)
					->required(),

				Forms\Components\TextInput::make('cost')
					->afterStateUpdated(fn($state, Set $set) => $set('cost', number_format(max(1, floatval($state)), 2, '.', '')))
					->numeric()
					->step('0.01')
					->required()
					->lazy(),

				Forms\Components\TextInput::make('price')
					->afterStateUpdated(fn($state, Set $set) => $set('price', number_format(max(1, floatval($state)), 2, '.', '')))
					->numeric()
					->step('0.01')
					->required()
					->lazy(),

				Forms\Components\Placeholder::make('margin')
					->content(function (Get $get) {
						$cost = floatval($get('cost'));
						$price = floatval($get('price'));
						if ($cost > 0 && $price > 0) {
							$margin = round((($price - $cost) / $price) * 100, 0);
							return $margin . '%';
						}
					}),

				Forms\Components\TextInput::make('weight')
					->numeric()
					->step('0.01')
					->required(),

				Forms\Components\Toggle::make('is_active')
					->inline(false)
					->default(true),
			])
			->columns(3);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				Tables\Columns\TextInputColumn::make('sku')
					->sortable()
					->rules([
						'unique',
						'max:255',
					]),

				Tables\Columns\TextInputColumn::make('name')
					->rules([
						'max:255',
					]),

				Tables\Columns\TextInputColumn::make('size')
					->rules([
						'max:255',
					]),

				Tables\Columns\TextInputColumn::make('cost')
					->type('number')
					->step('0.01')
					->rules([
						'min:1',
					]),

				Tables\Columns\TextInputColumn::make('price')->label('MSRP')
					->type('number')
					->step('0.01')
					->rules([
						'min:1',
					]),

				Tables\Columns\TextInputColumn::make('weight')
					->type('number')
					->step('0.01')
					->rules([
						'min:0',
					]),
			])
			->filters([
				//
			])
			->actions([
				Tables\Actions\EditAction::make(),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			])
			->recordTitleAttribute('sku');
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
			'index' => Pages\ListVariants::route('/'),
			'create' => Pages\CreateVariant::route('/create'),
			'edit' => Pages\EditVariant::route('/{record}/edit'),
		];
	}
}
