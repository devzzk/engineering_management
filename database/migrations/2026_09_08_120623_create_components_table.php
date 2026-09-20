<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete()->comment('品牌ID');
            $table->foreignId('component_category_id')->constrained('component_categories')->cascadeOnDelete()->comment('元器件分类ID');
            $table->string('name')->comment('元器件名称');
            $table->string('unit')->comment('单位');
            $table->decimal('power_consumption', 10, 2)->nullable()->comment('功耗(W)');
            $table->string('version')->comment('版本')->nullable();
            $table->string('code')->comment('订货号')->nullable();
            $table->decimal('unit_price', 12, 2)->comment('单价');
            $table->string('url')->comment('官网链接')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
