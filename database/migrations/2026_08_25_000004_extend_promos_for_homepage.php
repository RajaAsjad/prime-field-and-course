<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('promos', function (Blueprint $table) {
            $table->string('book_name')->nullable()->after('title');
            $table->string('book_class')->nullable()->after('book_name');
            $table->string('bonus_text')->nullable()->after('book_class');
            $table->string('cta_url')->nullable()->after('bonus_text');
            $table->string('cta_label')->default('Claim Bonus →')->after('cta_url');
            $table->boolean('is_featured')->default(false)->after('status');
            $table->string('ribbon_text')->nullable()->after('is_featured');
            $table->unsignedInteger('sort_order')->default(0)->after('ribbon_text');
        });
    }

    public function down(): void
    {
        Schema::table('promos', function (Blueprint $table) {
            $table->dropColumn([
                'book_name',
                'book_class',
                'bonus_text',
                'cta_url',
                'cta_label',
                'is_featured',
                'ribbon_text',
                'sort_order',
            ]);
        });
    }
};
