<?php

namespace App\Filament\Resources\Components\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ComponentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('基础信息')
                    ->schema([
                        TextEntry::make('brand.name')
                            ->label('品牌'),
                        TextEntry::make('componentCategory.name')
                            ->label('元器件分类'),
                        TextEntry::make('name')
                            ->label('元器件名称'),
                        TextEntry::make('unit')
                            ->label('单位'),
                        TextEntry::make('power_consumption')
                            ->label('功耗')
                            ->suffix(' W')
                            ->placeholder('-'),
                        TextEntry::make('version')
                            ->label('版本')
                            ->placeholder('-'),
                        TextEntry::make('code')
                            ->label('订货号')
                            ->placeholder('-'),
                    ])
                    ->columns(3),
                Section::make('价格与链接')
                    ->schema([
                        TextEntry::make('unit_price')
                            ->label('单价')
                            ->money('CNY'),
                        TextEntry::make('url')
                            ->label('官网链接')
                            ->url(fn (?string $state): ?string => $state)
                            ->openUrlInNewTab()
                            ->placeholder('-'),
                    ])
                    ->columns(2),
            ]);
    }
}
