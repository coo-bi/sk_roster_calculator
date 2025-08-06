<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CadreResource\Pages;
use App\Models\Cadre;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Filters\SelectFilter;

class CadreResource extends Resource
{
    protected static ?string $model = Cadre::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('cadre_name')
                    ->label('Cadre Name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->label('ID'),
                TextColumn::make('cadre_name')->sortable()->searchable()->label('Cadre Name'),
            ])
            ->filters([
                // SelectFilter::make('cadre_name')
                // ->label('Filter by Cadre Name')
                // ->options(Cadre::pluck('cadre_name', 'cadre_name')->toArray())
                // ->query(fn ($query, $value) => $query->where('cadre_name', $value)),
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
            'index' => Pages\ListCadres::route('/'),
            'create' => Pages\CreateCadre::route('/create'),
            'edit' => Pages\EditCadre::route('/{record}/edit'),
        ];
    }
}
