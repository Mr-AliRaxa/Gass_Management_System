<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Agency;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_owner')->default(false)->after('agency_id');
        });

        // Automatically set is_owner = true for the earliest user of each agency
        $agencies = Agency::all();
        foreach ($agencies as $agency) {
            $owner = User::where('agency_id', $agency->id)->orderBy('id', 'asc')->first();
            if ($owner) {
                $owner->is_owner = true;
                $owner->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_owner');
        });
    }
};
