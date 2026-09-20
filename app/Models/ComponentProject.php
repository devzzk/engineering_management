<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $project_id
 * @property int $component_id
 * @property string $quantity
 * @property string $unit_price
 * @property string $total_amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable([
    'project_id',
    'component_id',
    'quantity',
    'unit_price',
    'total_amount',
])]
class ComponentProject extends Pivot
{
    public $incrementing = true;

    protected $table = 'component_project';

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:3',
            'unit_price' => 'decimal:2',
            'total_amount' => 'decimal:2',
        ];
    }
}
