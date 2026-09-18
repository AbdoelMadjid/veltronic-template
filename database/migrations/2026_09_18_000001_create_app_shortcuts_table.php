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
        Schema::create('app_shortcuts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('key'); // e.g. 'm', 'k', 'l', '/'
            $table->boolean('ctrl')->default(false); // Ctrl / Command
            $table->boolean('alt')->default(false); // Alt / Option
            $table->boolean('shift')->default(false); // Shift
            $table->boolean('meta')->default(false); // Meta / Windows
            $table->string('action_type')->default('open_url'); // 'toggle_sidebar_menus', 'open_url', 'click_element', 'search', 'theme_mode', 'lock_screen', 'custom'
            $table->text('action_target')->nullable(); // Target URL or element selector
            $table->json('roles')->nullable(); // Allowed roles array e.g. ["master", "admin"] or null for all
            $table->text('description')->nullable();
            $table->boolean('is_enabled')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_shortcuts');
    }
};
