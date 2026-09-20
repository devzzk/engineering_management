<?php

namespace App\Filament\Resources\Components\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ComponentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('基础信息')
                    ->schema([
                        Select::make('brand_id')
                            ->label('品牌')
                            ->relationship('brand', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->native(false),
                        Select::make('component_category_id')
                            ->label('元器件分类')
                            ->relationship('componentCategory', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->native(false),
                        TextInput::make('name')
                            ->label('元器件名称')
                            ->required()
                            ->maxLength(255),
                        Select::make('unit')
                            ->label('单位')
                            ->options([
                                '个' => '个',
                                '扎' => '扎',
                                '米' => '米',
                                '袋' => '袋',
                                '台' => '台',
                                '箱' => '箱',
                            ])
                            ->required()
                            ->native(false),
                        TextInput::make('power_consumption')
                            ->label('功耗')
                            ->numeric()
                            ->suffix('W'),
                        TextInput::make('version')
                            ->label('版本')
                            ->maxLength(255),
                        TextInput::make('code')
                            ->label('订货号')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Section::make('价格与链接')
                    ->schema([
                        TextInput::make('unit_price')
                            ->label('单价')
                            ->numeric()
                            ->required()
                            ->prefix('￥'),
                        TextInput::make('url')
                            ->label('官网链接')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);
    }
}
