<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('基础信息')
                    ->schema([
                        TextInput::make('name')
                            ->label('品牌名称')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('code')
                            ->label('品牌编码')
                            ->maxLength(255),
                        TextInput::make('country')
                            ->label('国家 / 地区')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Section::make('补充说明')
                    ->schema([
                        Textarea::make('remark')
                            ->label('备注')
                            ->rows(4),
                    ])
                    ->columns(2),
            ]);
    }
}
