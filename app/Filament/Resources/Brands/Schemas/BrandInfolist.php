<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BrandInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('基础信息')
                    ->schema([
                        TextEntry::make('name')
                            ->label('品牌名称'),
                        TextEntry::make('code')
                            ->label('品牌编码')
                            ->placeholder('-'),
                        TextEntry::make('country')
                            ->label('国家 / 地区')
                            ->placeholder('-'),
                    ])
                    ->columns(2),
                Section::make('补充说明')
                    ->schema([
                        TextEntry::make('remark')
                            ->label('备注')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
