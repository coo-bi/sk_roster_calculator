<?php

namespace App\Filament\Resources\VerticalReservationResource\Pages;

use App\Filament\Resources\VerticalReservationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVerticalReservation extends EditRecord
{
    protected static string $resource = VerticalReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
