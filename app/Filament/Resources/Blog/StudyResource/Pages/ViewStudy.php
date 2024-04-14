<?php

namespace App\Filament\Resources\Blog\StudyResource\Pages;

use App\Filament\Resources\Blog\StudyResource;
use App\Models\Blog\Study;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewStudy extends ViewRecord
{
    protected static string $resource = StudyResource::class;

    public function getTitle(): string | Htmlable
    {
        /** @var Study */
        $record = $this->getRecord();

        return $record->title;
    }

    protected function getActions(): array
    {
        return [];
    }
}
