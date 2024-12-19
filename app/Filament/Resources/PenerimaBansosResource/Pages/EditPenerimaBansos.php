<?php

namespace App\Filament\Resources\PenerimaBansosResource\Pages;

use App\Filament\Resources\PenerimaBansosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenerimaBansos extends EditRecord
{
    protected static string $resource = PenerimaBansosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
