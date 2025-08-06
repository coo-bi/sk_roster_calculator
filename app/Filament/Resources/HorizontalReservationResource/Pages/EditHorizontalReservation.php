<?php

namespace App\Filament\Resources\HorizontalReservationResource\Pages;

use App\Filament\Resources\HorizontalReservationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHorizontalReservation extends EditRecord
{
    protected static string $resource = HorizontalReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
