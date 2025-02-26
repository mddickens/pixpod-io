<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqCategoryResource\Pages;
use App\Models\FaqCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FaqCategoryResource extends Resource
{
	protected static ?string $model = FaqCategory::class;

	protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
	protected static bool $shouldRegisterNavigation = false;
	protected static ?string $label = 'FAQs';

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				//
			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				//
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
			//
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ListFaqCategories::route('/'),
			'create' => Pages\CreateFaqCategory::route('/create'),
			'edit' => Pages\EditFaqCategory::route('/{record}/edit'),
		];
	}
}
