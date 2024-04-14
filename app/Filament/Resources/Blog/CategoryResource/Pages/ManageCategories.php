<?php

namespace App\Filament\Resources\Blog\CategoryResource\Pages;

use App\Filament\Exports\Blog\CategoryExporter;
use App\Filament\Imports\Blog\CategoryImporter;
use App\Filament\Resources\Blog\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCategories extends ManageRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ImportAction::make()
                ->importer(CategoryImporter::class),
            Actions\ExportAction::make()
                ->exporter(CategoryExporter::class),
            Actions\CreateAction::make(),
        ];
    }
}
