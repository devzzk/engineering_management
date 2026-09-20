<?php

namespace App\Models;

use Database\Factories\ComponentCategoryFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $remark
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable([
    'name',
    'description',
    'remark',
])]
class ComponentCategory extends Model
{
    /** @use HasFactory<ComponentCategoryFactory> */
    use HasFactory;

    public function components(): HasMany
    {
        return $this->hasMany(Component::class);
    }
}
