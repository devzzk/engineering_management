<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('基础信息')
                    ->schema([
                        TextEntry::make('name')
                            ->label('项目名称'),
                        TextEntry::make('code')
                            ->label('项目编号'),
                        TextEntry::make('status')
                            ->label('项目状态')
                            ->badge()
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'draft' => '草稿',
                                'pending' => '待启动',
                                'started' => '进行中',
                                'finished' => '已完成',
                                default => $state,
                            }),
                        TextEntry::make('customer_name')
                            ->label('客户名称'),
                        TextEntry::make('manager_name')
                            ->label('项目负责人'),
                        TextEntry::make('location')
                            ->label('项目地点'),
                    ])
                    ->columns(2),
                Section::make('计划与预算')
                    ->schema([
                        TextEntry::make('start_date')
                            ->label('开工日期')
                            ->date(),
                        TextEntry::make('end_date')
                            ->label('完工日期')
                            ->date(),
                        TextEntry::make('budget_amount')
                            ->label('项目预算')
                            ->formatStateUsing(fn (?string $state): string => filled($state) ? '￥'.$state : '-'),
                    ])
                    ->columns(3),
                Section::make('补充说明')
                    ->schema([
                        TextEntry::make('description')
                            ->label('项目描述')
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
