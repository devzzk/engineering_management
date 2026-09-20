<?php

namespace App\Filament\Resources\ComponentCategories;

use App\Filament\Resources\ComponentCategories\Pages\CreateComponentCategory;
use App\Filament\Resources\ComponentCategories\Pages\EditComponentCategory;
use App\Filament\Resources\ComponentCategories\Pages\ListComponentCategories;
use App\Filament\Resources\ComponentCategories\Pages\ViewComponentCategory;
use App\Filament\Resources\ComponentCategories\RelationManagers\ComponentsRelationManager;
use App\Filament\Resources\ComponentCategories\Schemas\ComponentCategoryForm;
use App\Filament\Resources\ComponentCategories\Schemas\ComponentCategoryInfolist;
use App\Filament\Resources\ComponentCategories\Tables\ComponentCategoriesTable;
use App\Models\ComponentCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ComponentCategoryResource extends Resource
{
    protected static ?string $model = ComponentCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = '元器件分类管理';

    protected static ?string $modelLabel = '元器件分类';

    protected static ?string $pluralModelLabel = '元器件分类';

    protected static string|UnitEnum|null $navigationGroup = '基础资料';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ComponentCategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ComponentCategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ComponentCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ComponentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComponentCategories::route('/'),
            'create' => CreateComponentCategory::route('/create'),
            'view' => ViewComponentCategory::route('/{record}'),
            'edit' => EditComponentCategory::route('/{record}/edit'),
        ];
    }
}
