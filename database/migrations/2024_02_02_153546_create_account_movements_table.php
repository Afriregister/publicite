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
        Schema::create('account_movements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id');
            $table->string('action')->nullable();
            $table->double('amount', 10, 2)->nullable()->default('0');
            $table->text('description')->nullable();
            $table->double('before', 10, 2)->nullable()->default('0');
            $table->double('after', 10, 2)->nullable()->default('0');
            $table->string('currency')->nullable()->default('BIF');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_movements');
    }
};
