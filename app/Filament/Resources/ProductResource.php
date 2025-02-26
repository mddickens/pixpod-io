<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
	protected static ?string $model = Product::class;

	protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static bool $shouldRegisterNavigation = false;

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\TextInput::make('name')
					->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
					->live(onBlur: true)
					->maxLength(255)
					->required(),

				Forms\Components\TextInput::make('slug')
					->unique(ignoreRecord: true)
					->maxLength(255)
					->required(),

				SpatieMediaLibraryFileUpload::make('blank_image')
					->collection('blanks')
					->conversion('thumb'),

				SpatieMediaLibraryFileUpload::make('catalog_images')
					->collection('catalog')
					->conversion('thumb'),

				TinyEditor::make('description')
					->columnSpan(2),

				Forms\Components\TextInput::make('material')
					->maxLength(255),

				Forms\Components\TextInput::make('packaging')
					->maxLength(255),

				Forms\Components\TextInput::make('search_terms')
					->maxLength(255),

				Forms\Components\Select::make('categories')->label('Associated categories')
					->relationship(titleAttribute: 'title')
					->multiple()
					->preload(),

				Forms\Components\TextInput::make('sort_order')
					->default(0)
					->numeric()
					->step(1),

				Forms\Components\Toggle::make('is_active')
					->inline(false)
					->default(true),
			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				Tables\Columns\ImageColumn::make('catalog_image')
					->defaultImageUrl(fn(Product $record): string => $record->getFirstMediaUrl('catalog', 'thumb'))
					->height(150)
					->width(150),

				Tables\Columns\TextColumn::make('name')
					->formatStateUsing(fn($state) => "<strong>$state</strong>")
					->sortable()
					->html(),

				Tables\Columns\TextColumn::make('description')
					->lineClamp(6)
					->wrap()
					->html(),

				Tables\Columns\TextColumn::make('id')->label('Variants')
					->formatStateUsing(fn(Product $record): string => $record->variants->count())
					->alignCenter(),

				Tables\Columns\TextColumn::make('sort_order')
					->alignCenter()
					->sortable(),

				Tables\Columns\ToggleColumn::make('is_active'),
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
			]);
	}

	public static function getRelations(): array
	{
		return [
			RelationManagers\VariantsRelationManager::class,
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ListProducts::route('/'),
			'create' => Pages\CreateProduct::route('/create'),
			'edit' => Pages\EditProduct::route('/{record}/edit'),
		];
	}
}
