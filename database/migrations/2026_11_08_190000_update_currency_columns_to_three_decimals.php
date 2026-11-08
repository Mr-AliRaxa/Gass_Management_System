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
        Schema::table('sales', function (Blueprint $table) {
            $table->decimal('total_amount', 12, 3)->default(0)->change();
        });

        Schema::table('sale_items', function (Blueprint $table) {
            $table->decimal('price', 12, 3)->change();
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->decimal('amount', 12, 3)->change();
        });

        Schema::table('salaries', function (Blueprint $table) {
            $table->decimal('amount', 12, 3)->change();
            $table->decimal('bonus', 12, 3)->default(0)->change();
        });

        Schema::table('cylinder_stocks', function (Blueprint $table) {
            $table->decimal('unit_price', 12, 3)->nullable()->default(0)->change();
            $table->decimal('total_cost', 12, 3)->nullable()->default(0)->change();
        });

        Schema::table('team_members', function (Blueprint $table) {
            $table->decimal('basic_salary', 12, 3)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->default(0)->change();
        });

        Schema::table('sale_items', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->change();
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->decimal('amount', 10, 2)->change();
        });

        Schema::table('salaries', function (Blueprint $table) {
            $table->decimal('amount', 10, 2)->change();
            $table->decimal('bonus', 10, 2)->default(0)->change();
        });

        Schema::table('cylinder_stocks', function (Blueprint $table) {
            $table->decimal('unit_price', 10, 2)->nullable()->default(0)->change();
            $table->decimal('total_cost', 10, 2)->nullable()->default(0)->change();
        });

        Schema::table('team_members', function (Blueprint $table) {
            $table->decimal('basic_salary', 10, 2)->default(0)->change();
        });
    }
};

