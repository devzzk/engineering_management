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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('品牌名称');
            $table->string('code')->nullable()->unique()->comment('品牌编码');
            $table->string('country')->nullable()->comment('国家或地区');
            // $table->string('contact_name')->nullable()->comment('联系人');
            // $table->string('contact_phone')->nullable()->comment('联系电话');
            $table->text('remark')->nullable()->comment('备注');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
