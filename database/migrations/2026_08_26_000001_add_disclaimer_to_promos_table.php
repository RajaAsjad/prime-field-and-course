<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('promos', function (Blueprint $table) {
            $table->string('disclaimer')->nullable()->after('description');
        });

        DB::table('promos')->whereNull('disclaimer')->update([
            'disclaimer' => '21+ only. Gambling problem? Call 1-800-GAMBLER',
        ]);
    }

    public function down(): void
    {
        Schema::table('promos', function (Blueprint $table) {
            $table->dropColumn('disclaimer');
        });
    }
};
