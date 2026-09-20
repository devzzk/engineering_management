<?php

namespace App\Filament\Resources\ComponentCategories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ComponentCategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('基础信息')
                    ->schema([
                        TextEntry::make('name')
                            ->label('分类名称'),
                    ]),
                Section::make('补充说明')
                    ->schema([
                        TextEntry::make('description')
                            ->label('描述')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('remark')
                            ->label('备注')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
