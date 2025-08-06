<?php

namespace App\Filament\Resources\HorizontalReservationResource\Pages;

use App\Filament\Resources\HorizontalReservationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHorizontalReservations extends ListRecords
{
    protected static string $resource = HorizontalReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
