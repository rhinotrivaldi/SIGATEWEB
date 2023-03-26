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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('period_date')->nullable()->after('status');
            $table->string('active_hour')->nullable()->after('periode_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            if (Schema::hasColumn('vehicles', 'periode_date')) {
                $table->dropColumn('period_date');
            }
            if (Schema::hasColumn('vehicles', 'active_hour')) {
                $table->dropColumn('active_hour');
            }
        });
    }
};
