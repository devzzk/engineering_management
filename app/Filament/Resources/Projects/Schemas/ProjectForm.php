<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('基础信息')
                    ->schema([
                        TextInput::make('name')
                            ->label('项目名称')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('code')
                            ->label('项目编号')
                            ->required()
                            ->maxLength(255),
                        Select::make('status')
                            ->label('项目状态')
                            ->options([
                                'draft' => '草稿',
                                'pending' => '待启动',
                                'started' => '进行中',
                                'finished' => '已完成',
                            ])
                            ->default('draft')
                            ->required()
                            ->native(false),
                        TextInput::make('customer_name')
                            ->label('客户名称')
                            ->maxLength(255),
                        TextInput::make('manager_name')
                            ->label('项目负责人')
                            ->maxLength(255),
                        TextInput::make('location')
                            ->label('项目地点')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Section::make('计划与预算')
                    ->schema([
                        DatePicker::make('start_date')
                            ->label('开工日期'),
                        DatePicker::make('end_date')
                            ->label('完工日期'),
                        TextInput::make('budget_amount')
                            ->label('项目预算')
                            ->numeric()
                            ->prefix('￥'),
                    ])
                    ->columns(2),
                Section::make('补充说明')
                    ->schema([
                        Textarea::make('description')
                            ->label('项目描述')
                            ->rows(4),
                        Textarea::make('remark')
                            ->label('备注')
                            ->rows(4),
                    ])
                    ->columns(2),
            ]);
    }
}
