<?php

namespace App\Models;

use Database\Factories\ComponentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $brand_id
 * @property int $component_category_id
 * @property string $name
 * @property string $unit
 * @property string|null $power_consumption
 * @property string|null $version
 * @property string|null $code
 * @property string $unit_price
 * @property string|null $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable([
    'brand_id',
    'component_category_id',
    'name',
    'unit',
    'power_consumption',
    'version',
    'code',
    'unit_price',
    'url',
])]
class Component extends Model
{
    /** @use HasFactory<ComponentFactory> */
    use HasFactory;

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function componentCategory(): BelongsTo
    {
        return $this->belongsTo(ComponentCategory::class);
    }

    public function componentProjects(): HasMany
    {
        return $this->hasMany(ComponentProject::class);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'component_project',
            'component_id',
            'project_id',
        )
            ->using(ComponentProject::class)
            ->withPivot([
                'quantity',
                'unit_price',
                'total_amount',
            ])
            ->withTimestamps();
    }

    protected function casts(): array
    {
        return [
            'power_consumption' => 'decimal:2',
            'unit_price' => 'decimal:2',
        ];
    }
}
