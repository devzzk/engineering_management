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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('项目名称');
            $table->string('code')->unique()->comment('项目编号');
            $table->string('customer_name')->nullable()->comment('客户名称');
            $table->string('manager_name')->nullable()->comment('项目负责人');
            $table->string('location')->nullable()->comment('项目地点');
            $table->enum('status', ['draft', 'pending', 'started', 'finished'])->default('draft')->index()->comment('项目状态');
            $table->date('start_date')->nullable()->comment('开工日期');
            $table->date('end_date')->nullable()->comment('完工日期');
            $table->decimal('budget_amount', 12, 2)->nullable()->comment('项目预算');
            $table->text('description')->nullable()->comment('项目描述');
            $table->text('remark')->nullable()->comment('备注');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
