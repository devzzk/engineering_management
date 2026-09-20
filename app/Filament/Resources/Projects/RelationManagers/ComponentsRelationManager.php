<?php

namespace App\Filament\Resources\Projects\RelationManagers;

use App\Filament\Resources\Components\ComponentResource;
use App\Models\Brand;
use App\Models\Component;
use App\Models\ComponentCategory;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ComponentsRelationManager extends RelationManager
{
    protected static string $relationship = 'components';

    protected static ?string $relatedResource = ComponentResource::class;

    protected static ?string $title = '元器件列表';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('quantity')
                    ->label('使用数量')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->minValue(0.001),
                TextInput::make('total_amount')
                    ->label('元器件总价')
                    ->numeric()
                    ->readOnly()
                    ->prefix('￥'),
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
                TextColumn::make('componentCategory.name')
                    ->label('元器件分类')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('元器件名称')
                    ->searchable(),
                TextColumn::make('code')
                    ->label('订货号')
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('unit')
                    ->label('单位')
                    ->badge(),
                TextColumn::make('pivot.quantity')
                    ->label('使用数量'),
                TextColumn::make('pivot.total_amount')
                    ->label('元器件总价')
                    ->money('CNY'),
                TextColumn::make('pivot.created_at')
                    ->label('关联时间')
                    ->dateTime('Y-m-d H:i'),
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
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('关联元器件')
                    ->action(function (AttachAction $action, array $data, Table $table): void {
                        $relationship = $table->getRelationship();

                        if (! $relationship instanceof BelongsToMany) {
                            $action->halt();
                        }

                        foreach ($data['component_items'] ?? [] as $componentItem) {
                            $componentId = (int) ($componentItem['component_id'] ?? 0);
                            $quantity = (float) ($componentItem['quantity'] ?? 1);
                            $unitPrice = (float) ($componentItem['unit_price'] ?? 0);

                            if ($componentId <= 0) {
                                continue;
                            }

                            $relationship->attach($componentId, [
                                'quantity' => $quantity,
                                'unit_price' => $unitPrice,
                                'total_amount' => round($quantity * $unitPrice, 2),
                            ]);
                        }

                        $action->success();
                    })
                    ->schema(fn (): array => [
                        Select::make('filter_brand_id')
                            ->label('筛选品牌')
                            ->options(fn (): array => Brand::query()->orderBy('name')->pluck('name', 'id')->all())
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->live()
                            ->afterStateUpdated(function (Select $component): void {
                                $this->resetSelectedComponents($component);
                            }),
                        Select::make('filter_component_category_id')
                            ->label('筛选元器件分类')
                            ->options(fn (): array => ComponentCategory::query()->orderBy('name')->pluck('name', 'id')->all())
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->live()
                            ->afterStateUpdated(function (Select $component): void {
                                $this->resetSelectedComponents($component);
                            }),
                        Select::make('recordId')
                            ->label('元器件')
                            ->key(fn (Get $get): string => 'recordId-'
                                .($get('filter_brand_id') ?? 'all').'-'
                                .($get('filter_component_category_id') ?? 'all'))
                            ->live()
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->placeholder('请选择元器件')
                            ->afterStateUpdated(function (Select $component, mixed $state): void {
                                $this->appendSelectedComponentItem($component, $state);
                            })
                            ->getOptionLabelUsing(fn ($value): ?string => filled($value)
                                ? Component::query()->find($value)?->name
                                : null)
                            ->options(fn (Get $get): array => $this->getAttachableComponentsQuery(
                                $get('filter_brand_id'),
                                $get('filter_component_category_id'),
                                $this->getSelectedComponentIdsFromItems($get('component_items')),
                            )
                                ->orderBy('name')
                                ->pluck('name', 'id')
                                ->all())
                            ->getSearchResultsUsing(fn (Get $get, string $search): array => $this->getAttachableComponentsQuery(
                                $get('filter_brand_id'),
                                $get('filter_component_category_id'),
                                $this->getSelectedComponentIdsFromItems($get('component_items')),
                            )
                                ->where(function ($query) use ($search): void {
                                    $query
                                        ->where('name', 'like', "%{$search}%")
                                        ->orWhere('code', 'like', "%{$search}%");
                                })
                                ->orderBy('name')
                                ->limit(50)
                                ->pluck('name', 'id')
                                ->all()),
                        Repeater::make('component_items')
                            ->label('已选元器件明细')
                            ->default([])
                            ->minItems(1)
                            ->deletable()
                            ->addable(false)
                            ->reorderable(false)
                            ->collapsible(false)
                            ->schema([
                                Hidden::make('component_id'),
                                Hidden::make('unit_price'),
                                TextInput::make('component_name')
                                    ->label('元器件')
                                    ->readOnly()
                                    ->dehydrated(false),
                                TextInput::make('quantity')
                                    ->label('使用数量')
                                    ->required()
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(0.001)
                                    ->afterStateUpdated(fn (Get $get, Set $set) => $set(
                                        'total_amount',
                                        round(((float) ($get('quantity') ?? 0)) * ((float) ($get('unit_price') ?? 0)), 2),
                                    ))
                                    ->live(),
                                TextInput::make('total_amount')
                                    ->label('元器件总价')
                                    ->prefix('￥')
                                    ->readOnly(),
                            ])
                            ->columns(3),
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ])
            ->defaultSort('component_project.created_at', 'desc');
    }

    protected function resetSelectedComponents(Select $component): void
    {
        $recordSelect = $component->getContainer()->getComponent('recordId', withHidden: true);

        if ($recordSelect instanceof Select) {
            $recordSelect->state(null);
            $recordSelect->refreshSelectedOptionLabel();
        }
    }

    protected function appendSelectedComponentItem(Select $component, mixed $state): void
    {
        $componentItems = $component->getContainer()->getComponent('component_items', withHidden: true);

        if (! $componentItems instanceof Repeater) {
            return;
        }

        $componentId = (int) ($state ?? 0);

        if ($componentId <= 0) {
            return;
        }

        $existingItems = collect($componentItems->getState() ?? []);

        if ($existingItems->contains(fn (array $item): bool => (int) ($item['component_id'] ?? 0) === $componentId)) {
            $component->state(null);
            $component->refreshSelectedOptionLabel();

            return;
        }

        $selectedComponent = Component::query()->find($componentId);

        if (! $selectedComponent) {
            return;
        }

        $componentItems->state(
            $existingItems
                ->push([
                    'component_id' => $selectedComponent->id,
                    'component_name' => $selectedComponent->name,
                    'unit_price' => $selectedComponent->unit_price,
                    'quantity' => 1,
                    'total_amount' => round((float) $selectedComponent->unit_price, 2),
                ])
                ->values()
                ->all(),
        );
    }

    /**
     * @param  array<int, array<string, mixed>>|null  $items
     * @return array<int>
     */
    protected function getSelectedComponentIdsFromItems(?array $items): array
    {
        return collect($items ?? [])
            ->map(fn (array $item): int => (int) ($item['component_id'] ?? 0))
            ->filter(fn (int $id): bool => $id > 0)
            ->values()
            ->all();
    }

    /**
     * @param  array<int>  $excludedComponentIds
     */
    protected function getAttachableComponentsQuery(?string $brandId, ?string $componentCategoryId, array $excludedComponentIds = []): Builder
    {
        return Component::query()
            ->whereDoesntHave('projects', fn (Builder $query): Builder => $query->whereKey($this->getOwnerRecord()->getKey()))
            ->when(
                filled($brandId),
                fn (Builder $query): Builder => $query->where('brand_id', $brandId),
            )
            ->when(
                filled($componentCategoryId),
                fn (Builder $query): Builder => $query->where('component_category_id', $componentCategoryId),
            )
            ->when(
                filled($excludedComponentIds),
                fn (Builder $query): Builder => $query->whereNotIn('id', $excludedComponentIds),
            );
    }
}
