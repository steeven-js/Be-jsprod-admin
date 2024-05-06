<?php

namespace App\Filament\Resources\ContactMailResource\Pages;

use App\Filament\Resources\ContactMailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactMail extends EditRecord
{
    protected static string $resource = ContactMailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
