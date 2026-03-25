<?php

namespace App\Filament\Resources\ToppingResource\Pages;

use App\Filament\Resources\ToppingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTopping extends EditRecord
{
    protected static string $resource = ToppingResource::class;

    protected function getValidationNotifications(): ?\Filament\Notifications\Notification
    {
        return \Filament\Notifications\Notification::make()
            ->title('Gagal menyimpan!')
            ->body('Silakan periksa kembali data yang wajib diisi.')
            ->danger()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
            $this->getCancelFormAction(),
        ];
    }
}
