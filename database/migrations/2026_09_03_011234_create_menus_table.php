<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('category')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedTinyInteger('paths')->nullable(); // Untuk jumlah path Keenicons (1, 2, 3...)
            $table->json('meta')->nullable();                 // Metadata: dropdown, target, badge, collapsed
            $table->boolean('active')->default(1);
            $table->integer('orders')->default(0);
            $table->foreignId('main_menu_id')->nullable()->constrained('menus')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};

