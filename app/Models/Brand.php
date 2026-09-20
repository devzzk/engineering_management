<?php

namespace App\Models;

use Database\Factories\BrandFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string|null $code
 * @property string|null $country
 * @property string|null $remark
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable([
    'name',
    'code',
    'country',
    'remark',
])]
class Brand extends Model
{
    /** @use HasFactory<BrandFactory> */
    use HasFactory;

    public function components(): HasMany
    {
        return $this->hasMany(Component::class);
    }
}
