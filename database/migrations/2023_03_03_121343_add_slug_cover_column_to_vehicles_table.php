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
            $table->string('slug')->nullable()->after('number_plate');
            $table->string('picture')->nullable()->after('number_plate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            if (Schema::hasColumn('vehicles', 'slug')) {
                $table->dropColumn('slug');
            }
            if (Schema::hasColumn('vehicles', 'picture')) {
                $table->dropColumn('picture');
            }
        });
    }
};
