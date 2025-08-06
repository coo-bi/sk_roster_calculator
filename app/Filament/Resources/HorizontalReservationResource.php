<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HorizontalReservationResource\Pages;
use App\Filament\Resources\HorizontalReservationResource\RelationManagers;
use App\Models\HorizontalReservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;



class HorizontalReservationResource extends Resource
{
    protected static ?string $model = HorizontalReservation::class;

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
                    return HorizontalReservation::query()
                        ->select('category_name')
                        ->distinct()
                        ->pluck('category_name', 'category_name');
                })
                ->searchable()
                ->placeholder('All Categories'),
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
            'index' => Pages\ListHorizontalReservations::route('/'),
            'create' => Pages\CreateHorizontalReservation::route('/create'),
            'edit' => Pages\EditHorizontalReservation::route('/{record}/edit'),
        ];
    }
}
