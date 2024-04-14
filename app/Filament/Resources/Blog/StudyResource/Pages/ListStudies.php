<?php

namespace App\Filament\Resources\Blog\StudyResource\Pages;

use App\Filament\Resources\Blog\StudyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudies extends ListRecords
{
    protected static string $resource = StudyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
