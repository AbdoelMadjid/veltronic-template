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
        // Add points and login tracking columns to users table if they don't already exist
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'points')) {
                $table->unsignedBigInteger('points')->default(0)->after('password');
            }
            if (!Schema::hasColumn('users', 'login_count')) {
                $table->unsignedBigInteger('login_count')->default(0)->after('points');
            }
            if (!Schema::hasColumn('users', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable()->after('login_count');
            }
            if (!Schema::hasColumn('users', 'last_point_at')) {
                $table->timestamp('last_point_at')->nullable()->after('last_login_at');
            }
        });

        // Create users_logins table for tracking all login and lockscreen events
        if (!Schema::hasTable('users_logins')) {
            Schema::create('users_logins', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->string('type', 50)->default('login'); // 'login' or 'lockscreen'
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->string('device', 50)->nullable(); // Desktop, Mobile, Tablet
                $table->string('browser', 50)->nullable(); // Chrome, Firefox, Safari, Edge, etc.
                $table->string('platform', 50)->nullable(); // Windows, MacOS, Linux, Android, iOS
                $table->unsignedTinyInteger('point_earned')->default(0); // 1 if awarded +1 point, 0 otherwise
                $table->timestamp('created_at')->useCurrent();

                $table->index(['user_id', 'created_at']);
                $table->index('type');
                $table->index('point_earned');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_logins');

        Schema::table('users', function (Blueprint $table) {
            $columnsToDrop = [];
            if (Schema::hasColumn('users', 'last_point_at')) {
                $columnsToDrop[] = 'last_point_at';
            }
            if (Schema::hasColumn('users', 'last_login_at')) {
                $columnsToDrop[] = 'last_login_at';
            }
            if (Schema::hasColumn('users', 'login_count')) {
                $columnsToDrop[] = 'login_count';
            }
            if (Schema::hasColumn('users', 'points')) {
                $columnsToDrop[] = 'points';
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
