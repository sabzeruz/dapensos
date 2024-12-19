<?php

namespace App\Filament\Resources\PenerimaBansosResource\Pages;

use App\Filament\Resources\PenerimaBansosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenerimaBansos extends ListRecords
{
    protected static string $resource = PenerimaBansosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
