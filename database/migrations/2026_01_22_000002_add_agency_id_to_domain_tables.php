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
        $tables = [
            'customers',
            'team_members',
            'attendances',
            'expense_types',
            'expenses',
            'salaries',
            'cylinder_stocks',
            'sales',
            'gas_readings',
            'visa_details'
        ];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->foreignId('agency_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
                });
            }
        }
        
        // sale_items usually belongs to sales, which already has agency_id. 
        // But if we want direct isolation, we can add it there too. 
        // For now, let's keep it consistent.
        if (Schema::hasTable('sale_items')) {
             Schema::table('sale_items', function (Blueprint $table) {
                $table->foreignId('agency_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'customers',
            'team_members',
            'attendances',
            'expense_types',
            'expenses',
            'salaries',
            'cylinder_stocks',
            'sales',
            'gas_readings',
            'visa_details',
            'sale_items'
        ];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropForeign(['agency_id']);
                    $table->dropColumn('agency_id');
                });
            }
        }
    }
};
