<?php

namespace App\Models;

use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $customer_name
 * @property string|null $manager_name
 * @property string|null $location
 * @property string $status
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * @property string|null $budget_amount
 * @property string|null $description
 * @property string|null $remark
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable([
    'name',
    'code',
    'customer_name',
    'manager_name',
    'location',
    'status',
    'start_date',
    'end_date',
    'budget_amount',
    'description',
    'remark',
])]
class Project extends Model
{
    /** @use HasFactory<ProjectFactory> */
    use HasFactory;

    public function componentProjects(): HasMany
    {
        return $this->hasMany(ComponentProject::class);
    }

    public function components(): BelongsToMany
    {
        return $this->belongsToMany(
            Component::class,
            'component_project',
            'project_id',
            'component_id',
        )
            ->using(ComponentProject::class)
            ->withPivot([
                'quantity',
                'unit_price',
                'total_amount',
            ])
            ->withTimestamps();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'budget_amount' => 'decimal:2',
        ];
    }
}
