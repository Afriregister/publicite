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
        Schema::table('users', function (Blueprint $table) {

            $table->string('role')->nullable()->after('firstname');
            $table->bigInteger('parent_id')->nullable()->after('firstname');
            $table->string('lastname')->nullable()->after('firstname');
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('phonenumber')->nullable();
            $table->integer('status')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn(['lastname', 'role', 'parent_id', 'country', 'city', 'address', 'phonenumber', 'status']);
        });
    }
};
