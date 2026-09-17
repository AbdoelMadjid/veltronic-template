<?php

namespace App\Console\Commands;

use App\Services\AppSupport\DatabaseBackupService;
use Illuminate\Console\Command;

class AutoBackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:auto-run {--force : Jalankan backup tanpa mengecek status toggle enabled}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menjalankan backup otomatis database terjadwal berdasarkan pengaturan sistem AppSetting';

    /**
     * Execute the console command.
     */
    public function handle(DatabaseBackupService $service)
    {
        $this->info('Memulai pengecekan tugas backup database otomatis...');

        $force = $this->option('force');
        $settings = $service->getAutoBackupSettings();

        if (!$settings['enabled'] && !$force) {
            $this->warn('Otomatisasi backup dinonaktifkan di pengaturan sistem.');
            return self::SUCCESS;
        }

        $this->info("Menjalankan backup ({$settings['backup_type']})...");
        $result = $service->runScheduledAutoBackup((bool) $force);

        if ($result['success']) {
            $this->info("Berhasil! File cadangan: {$result['file_name']} ({$result['file_size']})");
            return self::SUCCESS;
        } else {
            $this->error("Gagal: " . ($result['message'] ?? 'Terjadi kesalahan.'));
            return self::FAILURE;
        }
    }
}
