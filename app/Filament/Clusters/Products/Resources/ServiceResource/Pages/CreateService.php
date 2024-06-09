<?php

namespace App\Filament\Clusters\Products\Resources\ServiceResource\Pages;

use App\Filament\Clusters\Products\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;
}
