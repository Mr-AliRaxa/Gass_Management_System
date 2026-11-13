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
        Schema::table('gas_readings', function (Blueprint $table) {
            $table->decimal('start_reading', 12, 3)->change();
            $table->decimal('end_reading', 12, 3)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gas_readings', function (Blueprint $table) {
            $table->decimal('start_reading', 10, 2)->change();
            $table->decimal('end_reading', 10, 2)->nullable()->change();
        });
    }
};
