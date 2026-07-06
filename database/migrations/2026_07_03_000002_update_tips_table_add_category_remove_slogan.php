<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tips', function (Blueprint $table) {
            $table->foreignId('tips_category_id')
                ->nullable()
                ->after('title')
                ->constrained('tips_category')
                ->nullOnDelete();

            $table->dropColumn('slogan');
        });
    }

    public function down(): void
    {
        Schema::table('tips', function (Blueprint $table) {
            $table->string('slogan')->nullable()->after('title');

            $table->dropForeign(['tips_category_id']);
            $table->dropColumn('tips_category_id');
        });
    }
};
