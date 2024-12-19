<?php

namespace App\Filament\Resources\InfoPembuatResource\Pages;

use App\Filament\Resources\InfoPembuatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInfoPembuat extends EditRecord
{
    protected static string $resource = InfoPembuatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
