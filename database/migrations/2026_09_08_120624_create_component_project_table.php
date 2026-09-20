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
        Schema::create('component_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete()->comment('项目ID');
            $table->foreignId('component_id')->constrained()->cascadeOnDelete()->comment('元器件ID');
            $table->decimal('quantity', 12, 3)->default(1)->comment('使用数量');
            $table->decimal('unit_price', 12, 2)->comment('单价');
            $table->decimal('total_amount', 12, 2)->comment('总价');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_project');
    }
};
