<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->label('项目名称')
                    ->searchable(),
                TextColumn::make('code')
                    ->label('项目编号')
                    ->searchable(),
                TextColumn::make('customer_name')
                    ->label('客户名称')
                    ->searchable(),
                TextColumn::make('manager_name')
                    ->label('项目负责人'),
                TextColumn::make('status')
                    ->label('项目状态')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => '草稿',
                        'pending' => '待启动',
                        'started' => '进行中',
                        'finished' => '已完成',
                        default => $state,
                    }),
                TextColumn::make('start_date')
                    ->label('开工日期')
                    ->date(),
                TextColumn::make('end_date')
                    ->label('完工日期')
                    ->date(),
                TextColumn::make('created_at')
                    ->label('创建时间')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('项目状态')
                    ->options([
                        'draft' => '草稿',
                        'pending' => '待启动',
                        'started' => '进行中',
                        'finished' => '已完成',
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
