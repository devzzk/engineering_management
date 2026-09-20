<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Seeder;
use RuntimeException;

class ComponentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $payload = json_decode(
            file_get_contents(__DIR__ . '/components.json') ?: '',
            true,
        );

        if (! is_array($payload)) {
            throw new RuntimeException("无法读取或解析文件：components.json");
        }

        $components = $payload['components'] ?? null;

        if (! is_array($components)) {
            throw new RuntimeException('components.json 缺少 components 数组。');
        }

        Component::query()->upsert(
            $components,
            ['id'],
            [
                'brand_id',
                'component_category_id',
                'name',
                'unit',
                'power_consumption',
                'version',
                'code',
                'unit_price',
                'url',
                'created_at',
                'updated_at',
            ],
        );
    }
}
