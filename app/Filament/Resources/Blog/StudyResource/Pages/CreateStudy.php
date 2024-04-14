<?php

namespace App\Filament\Resources\Blog\StudyResource\Pages;

use App\Filament\Resources\Blog\StudyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStudy extends CreateRecord
{
    protected static string $resource = StudyResource::class;
}
