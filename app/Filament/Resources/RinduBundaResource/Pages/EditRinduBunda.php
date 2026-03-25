<?php

namespace App\Filament\Resources\RinduBundaResource\Pages;

use App\Filament\Resources\RinduBundaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRinduBunda extends EditRecord
{
    protected static string $resource = RinduBundaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Kosongkan agar tombol Delete tidak ada di header
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()
                ->label('create'),

            $this->getCancelFormAction()
                ->label('create & create another'),

            \Filament\Actions\DeleteAction::make()
                ->label('cancel')
                ->color('gray'),
        ];
    }
}
