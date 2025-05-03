<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BudgetCategoryResource\Pages;
use App\Filament\Resources\BudgetCategoryResource\RelationManagers;
use App\Models\BudgetCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BudgetCategoryResource extends Resource
{
    protected static ?string $model = BudgetCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            'index' => Pages\ListBudgetCategories::route('/'),
            'create' => Pages\CreateBudgetCategory::route('/create'),
            'edit' => Pages\EditBudgetCategory::route('/{record}/edit'),
        ];
    }
}
