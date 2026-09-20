<?php

namespace App\Filament\Resources\ComponentCategories\Pages;

use App\Filament\Resources\ComponentCategories\ComponentCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateComponentCategory extends CreateRecord
{
    protected static string $resource = ComponentCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
