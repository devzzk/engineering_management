<?php

namespace App\Filament\Resources\Components\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ComponentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('brand.name')
                    ->label('品牌')
                    ->searchable(),
                TextColumn::make('componentCategory.name')
                    ->label('元器件分类')
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
                    ->sortable(),
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
                TextColumn::make('created_at')
                    ->label('创建时间')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('brand_id')
                    ->label('品牌')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('component_category_id')
                    ->label('元器件分类')
                    ->relationship('componentCategory', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('unit')
                    ->label('单位')
                    ->options([
                        '个' => '个',
                        '扎' => '扎',
                        '米' => '米',
                        '袋' => '袋',
                        '台' => '台',
                        '箱' => '箱',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
