<?php

namespace App\Filament\Resources\ComponentCategories\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ComponentsRelationManager extends RelationManager
{
    protected static string $relationship = 'components';

    protected static ?string $title = '元器件列表';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('brand_id')
                    ->label('品牌')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
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
                TextInput::make('unit_price')
                    ->label('单价')
                    ->numeric()
                    ->required()
                    ->prefix('￥'),
                TextInput::make('url')
                    ->label('官网链接')
                    ->url()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('brand.name')
                    ->label('品牌')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('元器件名称')
                    ->searchable(),
                TextColumn::make('unit')
                    ->label('单位')
                    ->badge(),
                TextColumn::make('power_consumption')
                    ->label('功耗')
                    ->suffix(' W')
                    ->placeholder('-'),
                TextColumn::make('version')
                    ->label('版本')
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('code')
                    ->label('订货号')
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('unit_price')
                    ->label('单价')
                    ->money('CNY')
                    ->sortable(),
                TextColumn::make('url')
                    ->label('官网链接')
                    ->url(fn (?string $state): ?string => $state)
                    ->openUrlInNewTab()
                    ->limit(30)
                    ->placeholder('-'),
                TextColumn::make('created_at')
                    ->label('创建时间')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
