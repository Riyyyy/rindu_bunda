<?php

namespace App\Filament\Resources\ToppingResource\Pages;

use App\Filament\Resources\ToppingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTopping extends CreateRecord
{
    protected static string $resource = ToppingResource::class;

    protected function getValidationNotifications(): ?\Filament\Notifications\Notification
    {
        return \Filament\Notifications\Notification::make()
            ->title('Gagal menyimpan!')
            ->body('Silakan periksa kembali data yang wajib diisi.')
            ->danger() // Ini yang bikin warna merah (danger)
            ->send();
    }
}
