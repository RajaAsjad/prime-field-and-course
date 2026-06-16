<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('tag')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('bullets')->nullable();
            $table->string('image')->nullable();
            $table->string('icon')->default('golf');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('process_steps', function (Blueprint $table) {
            $table->id();
            $table->string('step_number', 4)->nullable();
            $table->string('phase_label')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('portfolio_items', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('category_label')->nullable();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        $modules = ['service', 'process', 'portfolio'];
        $actions = ['list', 'create', 'edit', 'delete'];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                $name = "{$module}-{$action}";
                $exists = DB::table('permissions')->where('name', $name)->exists();
                if (!$exists) {
                    $id = DB::table('permissions')->insertGetId([
                        'name' => $name,
                        'guard_name' => 'web',
                        'permission' => $action === 'list' ? 'list' : $action,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $roleIds = DB::table('roles')->pluck('id');
                    foreach ($roleIds as $roleId) {
                        DB::table('role_has_permissions')->insertOrIgnore([
                            'permission_id' => $id,
                            'role_id' => $roleId,
                        ]);
                    }
                }
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_items');
        Schema::dropIfExists('process_steps');
        Schema::dropIfExists('services');

        $names = [];
        foreach (['service', 'process', 'portfolio'] as $module) {
            foreach (['list', 'create', 'edit', 'delete'] as $action) {
                $names[] = "{$module}-{$action}";
            }
        }
        $ids = DB::table('permissions')->whereIn('name', $names)->pluck('id');
        DB::table('role_has_permissions')->whereIn('permission_id', $ids)->delete();
        DB::table('permissions')->whereIn('id', $ids)->delete();
    }
};
