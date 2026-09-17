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
        Schema::table('users_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('users_logs', 'module')) {
                $table->string('module', 50)->default('sistem')->after('user_id')->index();
            }
            if (!Schema::hasColumn('users_logs', 'menu')) {
                $table->string('menu', 50)->default('umum')->after('module')->index();
            }
            if (!Schema::hasColumn('users_logs', 'level')) {
                $table->string('level', 20)->default('info')->after('menu')->index(); // info, warning, error, success
            }
        });

        // Make user_id nullable in case of system background errors
        Schema::table('users_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_logs', function (Blueprint $table) {
            $columnsToDrop = [];
            if (Schema::hasColumn('users_logs', 'level')) {
                $columnsToDrop[] = 'level';
            }
            if (Schema::hasColumn('users_logs', 'menu')) {
                $columnsToDrop[] = 'menu';
            }
            if (Schema::hasColumn('users_logs', 'module')) {
                $columnsToDrop[] = 'module';
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
