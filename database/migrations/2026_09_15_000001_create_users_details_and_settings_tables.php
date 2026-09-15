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
        Schema::create('users_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            
            // Data KTP
            $table->string('nik', 20)->nullable()->index();
            $table->string('nama_lengkap')->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin', 20)->nullable(); // Laki-laki / Perempuan
            $table->string('golongan_darah', 5)->nullable(); // A, B, AB, O
            $table->string('agama', 50)->nullable();
            $table->string('status_perkawinan', 50)->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->string('kewarganegaraan', 50)->default('WNI');
            $table->string('berlaku_hingga', 50)->default('Seumur Hidup');
            $table->string('foto_ktp')->nullable();

            // Alamat Terpisah
            $table->string('alamat_jalan')->nullable();
            $table->string('blok', 50)->nullable();
            $table->string('nomor_rumah', 50)->nullable();
            $table->string('rt', 10)->nullable();
            $table->string('rw', 10)->nullable();
            $table->string('desa', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kabupaten', 100)->nullable();
            $table->string('provinsi', 100)->nullable();
            $table->string('kode_pos', 10)->nullable();

            // Kontak Tambahan
            $table->string('no_hp', 25)->nullable();

            $table->timestamps();
        });

        Schema::create('users_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('key', 100);
            $table->longText('value')->nullable();
            $table->string('group', 50)->default('general');
            $table->timestamps();

            $table->unique(['user_id', 'key']);
        });

        Schema::create('users_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('activity');
            $table->text('description')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_logs');
        Schema::dropIfExists('users_settings');
        Schema::dropIfExists('users_details');
    }
};
