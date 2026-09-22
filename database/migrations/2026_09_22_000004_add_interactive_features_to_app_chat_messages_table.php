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
        Schema::table('app_chat_messages', function (Blueprint $table) {
            $table->foreignId('reply_to_id')->nullable()->after('receiver_id')->constrained('app_chat_messages')->nullOnDelete();
            $table->boolean('is_edited')->default(false)->after('attachment_size');
            $table->timestamp('edited_at')->nullable()->after('is_edited');
            $table->boolean('is_pinned')->default(false)->after('edited_at')->index();
            $table->timestamp('pinned_at')->nullable()->after('is_pinned');
            $table->foreignId('pinned_by')->nullable()->after('pinned_at')->constrained('users')->nullOnDelete();
            $table->json('reactions')->nullable()->after('pinned_by');
            $table->boolean('is_forwarded')->default(false)->after('reactions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_chat_messages', function (Blueprint $table) {
            $table->dropForeign(['reply_to_id']);
            $table->dropForeign(['pinned_by']);
            $table->dropColumn([
                'reply_to_id',
                'is_edited',
                'edited_at',
                'is_pinned',
                'pinned_at',
                'pinned_by',
                'reactions',
                'is_forwarded',
            ]);
        });
    }
};
