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
        Schema::table('cylinder_stocks', function (Blueprint $table) {
            $table->decimal('unit_price', 10, 2)->nullable()->default(0)->after('quantity');
            $table->decimal('total_cost', 10, 2)->nullable()->default(0)->after('unit_price');
            $table->date('transaction_date')->nullable()->after('total_cost');
            $table->string('supplier_name')->nullable()->after('transaction_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cylinder_stocks', function (Blueprint $table) {
            $table->dropColumn(['unit_price', 'total_cost', 'transaction_date', 'supplier_name']);
        });
    }
};
