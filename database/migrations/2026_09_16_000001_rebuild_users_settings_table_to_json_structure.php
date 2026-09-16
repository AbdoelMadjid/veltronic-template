<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Backup existing EAV settings data grouped by user_id
        $aggregatedSettings = [];

        if (Schema::hasTable('users_settings')) {
            try {
                $oldRows = DB::table('users_settings')->get();
                foreach ($oldRows as $row) {
                    $userId = $row->user_id;
                    if (!isset($aggregatedSettings[$userId])) {
                        $aggregatedSettings[$userId] = [
                            'user_id' => $userId,
                            'profile_cover' => [],
                            'preferences' => [],
                            'custom' => [],
                            'created_at' => $row->created_at ?? now(),
                            'updated_at' => $row->updated_at ?? now(),
                        ];
                    }

                    $key = $row->key;
                    $value = $row->value;
                    $group = $row->group ?? 'general';

                    if ($group === 'profile_cover' || in_array($key, [
                        'cover_background', 'cover_opacity', 'cover_overlay_color',
                        'cover_position_y', 'cover_height', 'cover_blur'
                    ])) {
                        $aggregatedSettings[$userId]['profile_cover'][$key] = $value;
                    } elseif ($group === 'preferences' || in_array($key, [
                        'notifikasi_email', 'notifikasi_wa', 'autolock_screen',
                        'bahasa_default', 'tema_default', 'dua_faktor'
                    ])) {
                        $aggregatedSettings[$userId]['preferences'][$key] = $value;
                    } else {
                        $aggregatedSettings[$userId]['custom'][$key] = $value;
                    }
                }
            } catch (\Throwable $e) {
                // Ignore if unable to read old data
            }

            Schema::dropIfExists('users_settings');
        }

        // 2. Create new optimized 1-User-1-Row table with categorized JSON columns
        Schema::create('users_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->json('profile_cover')->nullable();
            $table->json('preferences')->nullable();
            $table->json('custom')->nullable();
            $table->timestamps();
        });

        // 3. Re-insert aggregated settings data into new JSON schema
        foreach ($aggregatedSettings as $data) {
            DB::table('users_settings')->insert([
                'user_id' => $data['user_id'],
                'profile_cover' => !empty($data['profile_cover']) ? json_encode($data['profile_cover']) : null,
                'preferences' => !empty($data['preferences']) ? json_encode($data['preferences']) : null,
                'custom' => !empty($data['custom']) ? json_encode($data['custom']) : null,
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at'],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $backupRows = [];

        if (Schema::hasTable('users_settings')) {
            try {
                $rows = DB::table('users_settings')->get();
                foreach ($rows as $row) {
                    $userId = $row->user_id;

                    $cover = json_decode($row->profile_cover ?? '{}', true) ?: [];
                    foreach ($cover as $k => $v) {
                        $backupRows[] = [
                            'user_id' => $userId,
                            'key' => $k,
                            'value' => $v,
                            'group' => 'profile_cover',
                            'created_at' => $row->created_at,
                            'updated_at' => $row->updated_at,
                        ];
                    }

                    $pref = json_decode($row->preferences ?? '{}', true) ?: [];
                    foreach ($pref as $k => $v) {
                        $backupRows[] = [
                            'user_id' => $userId,
                            'key' => $k,
                            'value' => $v,
                            'group' => 'preferences',
                            'created_at' => $row->created_at,
                            'updated_at' => $row->updated_at,
                        ];
                    }

                    $custom = json_decode($row->custom ?? '{}', true) ?: [];
                    foreach ($custom as $k => $v) {
                        $backupRows[] = [
                            'user_id' => $userId,
                            'key' => $k,
                            'value' => $v,
                            'group' => 'general',
                            'created_at' => $row->created_at,
                            'updated_at' => $row->updated_at,
                        ];
                    }
                }
            } catch (\Throwable $e) {}

            Schema::dropIfExists('users_settings');
        }

        Schema::create('users_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('key', 100);
            $table->longText('value')->nullable();
            $table->string('group', 50)->default('general');
            $table->timestamps();

            $table->unique(['user_id', 'key']);
        });

        if (!empty($backupRows)) {
            DB::table('users_settings')->insert($backupRows);
        }
    }
};
