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
        Schema::create('ads_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id');
            $table->foreignId('ads_type_id');
            $table->foreignId('ads_format_id');
            $table->foreignId('program_id')->nullable();
            $table->foreignId('package_id')->nullable();
            $table->foreignId('period_id')->nullable();
            $table->double('price',12,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads_prices');
    }
};
