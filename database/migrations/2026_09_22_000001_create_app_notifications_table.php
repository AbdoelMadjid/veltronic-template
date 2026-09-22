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
        Schema::create('app_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('target_role', 50)->nullable()->comment('Null for user specific, or master/admin/all');
            $table->string('category', 50)->default('system')->comment('friendship, security, account, chat, system');
            $table->string('type', 100)->default('general')->comment('friend_request, password_reset_request, deactivate_request, etc.');
            $table->string('title', 255);
            $table->text('message')->nullable();
            $table->string('icon', 100)->default('ki-notification-status');
            $table->string('color', 50)->default('primary');
            $table->string('action_url', 500)->nullable();
            $table->json('data')->nullable()->comment('Custom payload: sender_id, target_id, extra metadata');
            $table->string('action_state', 50)->nullable()->comment('pending, accepted, declined, processed');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            // Performance indexes
            $table->index(['user_id', 'is_read']);
            $table->index(['target_role', 'is_read']);
            $table->index(['category']);
            $table->index(['type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_notifications');
    }
};
