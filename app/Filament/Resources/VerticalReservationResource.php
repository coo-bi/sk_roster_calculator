<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VerticalReservationResource\Pages;
use App\Models\VerticalReservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Filters\SelectFilter;

class VerticalReservationResource extends Resource
{
    protected static ?string $model = VerticalReservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('category_name')
                    ->label('Category Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('category_percentage')
                    ->label('Category Percentage')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->maxValue(100)
                    ->suffix('%'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('category_name')->label('Category Name')->searchable()->sortable(),
                TextColumn::make('category_percentage')->label('Category %')->sortable(),
            ])
            ->filters([
                Filter::make('High Percentage')
                    ->query(fn ($query) => $query->where('category_percentage', '>=', 50)),

                Filter::make('Low Percentage')
                    ->query(fn ($query) => $query->where('category_percentage', '<', 50)),

                SelectFilter::make('category_name')
                ->label('Category')
                ->options(function () {
                    return VerticalReservation::query()
                        ->select('category_name')
                        ->distinct()
                        ->pluck('category_name', 'category_name');
                })
                ->searchable()
                ->placeholder('All Categories'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVerticalReservations::route('/'),
            'create' => Pages\CreateVerticalReservation::route('/create'),
            'edit' => Pages\EditVerticalReservation::route('/{record}/edit'),
        ];
    }
}
