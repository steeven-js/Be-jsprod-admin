<?php

namespace App\Filament\Resources\ContactMailResource\Pages;

use App\Filament\Resources\ContactMailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactMails extends ListRecords
{
    protected static string $resource = ContactMailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
