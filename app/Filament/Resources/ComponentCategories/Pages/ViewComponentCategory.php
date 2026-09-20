<?php

namespace App\Filament\Resources\ComponentCategories\Pages;

use App\Filament\Resources\ComponentCategories\ComponentCategoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewComponentCategory extends ViewRecord
{
    protected static string $resource = ComponentCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
