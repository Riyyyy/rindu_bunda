<?php

namespace App\Filament\Resources\RinduBundaResource\Pages;

use App\Filament\Resources\RinduBundaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRinduBundas extends ListRecords
{
    protected static string $resource = RinduBundaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
